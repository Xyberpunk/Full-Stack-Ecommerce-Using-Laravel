<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CheckoutRequest;
use App\Mail\OrderConfirmationMail;
use App\Models\Order;
use App\Services\CartService;
use App\Services\CatalogService;
use App\Services\CheckoutPricingService;
use App\Services\CouponService;
use App\Services\InventoryService;
use App\Services\StripeCheckoutService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function __construct(
        private readonly CartService $cart,
        private readonly CatalogService $catalog,
        private readonly CouponService $coupons,
        private readonly CheckoutPricingService $pricing,
        private readonly InventoryService $inventory,
        private readonly StripeCheckoutService $stripe,
    ) {
    }

    public function store(CheckoutRequest $request): JsonResponse
    {
        $token = $request->string('cart_token')->toString();
        $cart = $this->cart->load($request->user()?->id, $token);

        if (count($cart['items']) === 0) {
            return response()->json([
                'message' => 'Cart is empty.',
            ], 422);
        }

        $orderNumber = 'ORD-' . strtoupper(Str::random(10));
        $lineItems = [];
        $subtotal = 0;

        foreach ($cart['items'] as $productId => $quantity) {
            $product = $this->catalog->find((string) $productId);
            if (!$product) {
                continue;
            }

            $lineTotal = ((float) $product['price']) * $quantity;
            $subtotal += $lineTotal;

            $lineItems[] = [
                'product_id' => (int) $productId,
                'product_name' => $product['name'],
                'unit_price' => (float) $product['price'],
                'quantity' => $quantity,
                'line_total' => $lineTotal,
            ];
        }

        if (count($lineItems) === 0) {
            return response()->json([
                'message' => 'No valid products were found in the cart.',
            ], 422);
        }

        $shippingMethod = $request->string('shipping_method')->toString() ?: 'standard';
        $paymentMethod = $request->string('payment_method')->toString() ?: 'cod';
        $summary = $this->pricing->summarize(
            subtotal: (float) $subtotal,
            couponCode: $request->string('coupon_code')->toString(),
            shippingMethod: $shippingMethod,
        );

        if ($paymentMethod === 'stripe' && !$this->stripe->configured()) {
            return response()->json([
                'message' => 'Stripe is not configured yet. Add STRIPE_KEY, STRIPE_SECRET, and STRIPE_WEBHOOK_SECRET in .env before using card payments.',
            ], 422);
        }

        $order = DB::transaction(function () use ($request, $orderNumber, $lineItems, $cart, $summary, $paymentMethod, $shippingMethod) {
            $invoiceNumber = 'INV-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));
            $order = Order::create([
                'user_id' => $request->user()?->id,
                'order_number' => $orderNumber,
                'invoice_number' => $invoiceNumber,
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_method' => $paymentMethod,
                'shipping_method' => $shippingMethod,
                'coupon_code' => $summary['coupon']?->code,
                'subtotal' => $summary['discounted_subtotal'],
                'tax' => $summary['tax'],
                'tax_rate' => $summary['tax_rate'],
                'shipping' => $summary['shipping'],
                'discount' => $summary['discount'],
                'total' => $summary['total'],
                'customer_name' => $request->string('name')->toString(),
                'customer_email' => $request->string('email')->toString(),
                'customer_phone' => $request->string('phone')->toString(),
                'shipping_address' => $request->string('address')->toString(),
                'notes' => $request->string('notes')->toString(),
                'invoice_generated_at' => now(),
            ]);

            foreach ($lineItems as $item) {
                $order->items()->create($item);
            }

            if ($paymentMethod !== 'stripe') {
                $this->inventory->decreaseForOrder($order);
            }

            if ($summary['coupon']) {
                $summary['coupon']->increment('used_count');
            }

            if ($request->boolean('save_details') && $request->user()) {
                $request->user()->update([
                    'phone' => $request->string('phone')->toString(),
                    'default_payment_method' => $paymentMethod,
                    'preferred_shipping_method' => $shippingMethod,
                ]);
            }

            return $order;
        });

        $order->load('items.product');

        if ($paymentMethod === 'stripe') {
            $session = $this->stripe->createCheckoutSession(
                order: $order,
                lineItems: $lineItems,
                successUrl: url('/checkout?stripe=success&order=' . $order->order_number . '&session_id={CHECKOUT_SESSION_ID}'),
                cancelUrl: url('/checkout?stripe=cancelled&order=' . $order->order_number),
            );

            $order->update([
                'stripe_session_id' => $session['id'],
                'payment_reference' => $session['payment_intent'] ?: $session['id'],
            ]);

            return response()->json([
                'message' => 'Redirecting to Stripe checkout.',
                'order_number' => $order->order_number,
                'order_id' => $order->id,
                'checkout_url' => $session['url'],
            ], 202);
        }

        $this->cart->clear($request->user()?->id, $cart['token']);

        try {
            Mail::to($order->customer_email)->send(new OrderConfirmationMail($order));
        } catch (\Throwable) {
        }

        return response()->json([
            'message' => 'Order created successfully.',
            'order_number' => $order->order_number,
            'invoice_number' => $order->invoice_number,
            'order_id' => $order->id,
            'discount' => $summary['discount'],
            'shipping' => $summary['shipping'],
            'tax' => $summary['tax'],
            'total' => $summary['total'],
        ], 201);
    }
}
