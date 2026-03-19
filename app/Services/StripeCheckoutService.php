<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class StripeCheckoutService
{
    public function __construct(
        private readonly HttpFactory $http,
    ) {
    }

    public function configured(): bool
    {
        return filled(config('services.stripe.secret')) && filled(config('services.stripe.webhook_secret'));
    }

    /**
     * @param  array<int, array<string, mixed>>  $lineItems
     * @return array{id: string, url: string, payment_intent?: string|null}
     */
    public function createCheckoutSession(Order $order, array $lineItems, string $successUrl, string $cancelUrl): array
    {
        if (!$this->configured()) {
            throw ValidationException::withMessages([
                'payment_method' => 'Stripe is not configured yet. Add Stripe keys before using card payments.',
            ]);
        }

        $payload = [
            'mode' => 'payment',
            'success_url' => $successUrl,
            'cancel_url' => $cancelUrl,
            'client_reference_id' => (string) $order->id,
            'customer_email' => $order->customer_email,
            'metadata[order_id]' => (string) $order->id,
            'metadata[order_number]' => $order->order_number,
            'line_items[0][quantity]' => 1,
            'line_items[0][price_data][currency]' => strtolower((string) config('services.stripe.currency', 'usd')),
            'line_items[0][price_data][unit_amount]' => (int) round(((float) $order->total) * 100),
            'line_items[0][price_data][product_data][name]' => "Order {$order->order_number}",
            'line_items[0][price_data][product_data][description]' => 'Store checkout payment',
        ];

        $response = $this->http
            ->withBasicAuth(config('services.stripe.secret'), '')
            ->asForm()
            ->post('https://api.stripe.com/v1/checkout/sessions', $payload)
            ->throw()
            ->json();

        return [
            'id' => (string) Arr::get($response, 'id'),
            'url' => (string) Arr::get($response, 'url'),
            'payment_intent' => Arr::get($response, 'payment_intent'),
        ];
    }

    public function verifyWebhookSignature(string $payload, string $signatureHeader): void
    {
        $secret = (string) config('services.stripe.webhook_secret');
        if ($secret === '') {
            throw ValidationException::withMessages([
                'stripe' => 'Stripe webhook secret is missing.',
            ]);
        }

        $parts = collect(explode(',', $signatureHeader))
            ->mapWithKeys(function (string $part): array {
                [$key, $value] = array_pad(explode('=', $part, 2), 2, null);
                return [$key => $value];
            });

        $timestamp = $parts->get('t');
        $signature = $parts->get('v1');

        if (!$timestamp || !$signature) {
            throw ValidationException::withMessages([
                'stripe' => 'Invalid Stripe signature header.',
            ]);
        }

        $signedPayload = $timestamp . '.' . $payload;
        $expected = hash_hmac('sha256', $signedPayload, $secret);

        if (!hash_equals($expected, $signature)) {
            throw ValidationException::withMessages([
                'stripe' => 'Invalid Stripe webhook signature.',
            ]);
        }
    }
}
