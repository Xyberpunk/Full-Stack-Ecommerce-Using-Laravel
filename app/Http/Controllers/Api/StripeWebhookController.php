<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmationMail;
use App\Models\Order;
use App\Services\InventoryService;
use App\Services\StripeCheckoutService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StripeWebhookController extends Controller
{
    public function __construct(
        private readonly StripeCheckoutService $stripe,
        private readonly InventoryService $inventory,
    ) {
    }

    public function handle(Request $request): JsonResponse
    {
        $payload = $request->getContent();
        $signature = (string) $request->header('Stripe-Signature', '');

        $this->stripe->verifyWebhookSignature($payload, $signature);

        /** @var array<string, mixed> $event */
        $event = json_decode($payload, true, 512, JSON_THROW_ON_ERROR);
        $type = (string) ($event['type'] ?? '');
        $object = $event['data']['object'] ?? [];

        if ($type === 'checkout.session.completed') {
            $order = Order::query()
                ->where('stripe_session_id', $object['id'] ?? null)
                ->orWhere('id', $object['metadata']['order_id'] ?? null)
                ->first();

            if ($order) {
                $oldStatus = $order->status;
                $oldPaymentStatus = $order->payment_status;

                if ($order->payment_status !== 'paid') {
                    $this->inventory->decreaseForOrder($order);
                }

                $order->update([
                    'payment_status' => 'paid',
                    'status' => $order->status === 'pending' ? 'processing' : $order->status,
                    'payment_reference' => $object['payment_intent'] ?? ($object['id'] ?? null),
                    'payment_failure_reason' => null,
                ]);

                $order->statusLogs()->create([
                    'user_id' => null,
                    'from_status' => $oldStatus,
                    'to_status' => $order->status,
                    'from_payment_status' => $oldPaymentStatus,
                    'to_payment_status' => 'paid',
                    'note' => 'Stripe checkout session completed.',
                ]);

                try {
                    Mail::to($order->customer_email)->send(new OrderConfirmationMail($order->fresh('items.product')));
                } catch (\Throwable) {
                }
            }
        }

        if (in_array($type, ['checkout.session.expired', 'payment_intent.payment_failed'], true)) {
            $reference = $object['id'] ?? null;
            $order = Order::query()
                ->where('stripe_session_id', $reference)
                ->orWhere('payment_reference', $reference)
                ->first();

            if ($order) {
                $oldStatus = $order->status;
                $oldPaymentStatus = $order->payment_status;

                $order->update([
                    'payment_status' => 'failed',
                    'payment_failure_reason' => $object['last_payment_error']['message'] ?? 'Stripe payment failed or expired.',
                ]);

                $order->statusLogs()->create([
                    'user_id' => null,
                    'from_status' => $oldStatus,
                    'to_status' => $order->status,
                    'from_payment_status' => $oldPaymentStatus,
                    'to_payment_status' => 'failed',
                    'note' => $order->payment_failure_reason,
                ]);
            }
        }

        if ($type === 'charge.refunded') {
            $paymentIntent = $object['payment_intent'] ?? null;
            $order = Order::query()->where('payment_reference', $paymentIntent)->first();

            if ($order) {
                $oldStatus = $order->status;
                $oldPaymentStatus = $order->payment_status;
                $order->update([
                    'payment_status' => 'refunded',
                    'status' => 'returned',
                ]);

                $order->statusLogs()->create([
                    'user_id' => null,
                    'from_status' => $oldStatus,
                    'to_status' => 'returned',
                    'from_payment_status' => $oldPaymentStatus,
                    'to_payment_status' => 'refunded',
                    'note' => 'Stripe charge refunded.',
                ]);
            }
        }

        return response()->json(['received' => true]);
    }
}
