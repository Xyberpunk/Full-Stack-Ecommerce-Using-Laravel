<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CartItemStoreRequest;
use App\Http\Requests\Api\CartItemUpdateRequest;
use App\Services\CheckoutPricingService;
use App\Services\CartService;
use App\Services\CatalogService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(
        private readonly CartService $cart,
        private readonly CatalogService $catalog,
        private readonly CheckoutPricingService $pricing,
    ) {
    }

    public function show(Request $request): JsonResponse
    {
        $token = $this->token($request);
        $cart = $this->cart->load($request->user()?->id, $token);

        return $this->cartResponse($cart['token'], $cart['items']);
    }

    public function store(CartItemStoreRequest $request): JsonResponse
    {
        $token = $this->token($request) ?? '';
        $productId = $request->string('product_id')->toString();
        $quantity = $request->integer('quantity', 1);

        $cart = $this->cart->load($request->user()?->id, $token);
        $updated = $this->cart->add($request->user()?->id, $cart['token'], $productId, $quantity);

        return $this->cartResponse($updated['token'], $updated['items'], 201);
    }

    public function update(string $productId, CartItemUpdateRequest $request): JsonResponse
    {
        $token = $this->token($request) ?? '';
        $quantity = $request->integer('quantity');

        $cart = $this->cart->load($request->user()?->id, $token);
        $updated = $this->cart->setQty($request->user()?->id, $cart['token'], $productId, $quantity);

        return $this->cartResponse($updated['token'], $updated['items']);
    }

    public function destroy(string $productId, Request $request): JsonResponse
    {
        $token = $this->token($request) ?? '';

        $cart = $this->cart->load($request->user()?->id, $token);
        $updated = $this->cart->remove($request->user()?->id, $cart['token'], $productId);

        return $this->cartResponse($updated['token'], $updated['items']);
    }

    public function clear(Request $request): JsonResponse
    {
        $token = $this->token($request) ?? '';
        $cart = $this->cart->load($request->user()?->id, $token);
        $cleared = $this->cart->clear($request->user()?->id, $cart['token']);

        return $this->cartResponse($cleared['token'], $cleared['items']);
    }

    /**
     * @param  array<string, int>  $items
     */
    private function cartResponse(string $token, array $items, int $status = 200): JsonResponse
    {
        $lineItems = [];
        $subtotal = 0.0;

        foreach ($items as $productId => $qty) {
            $product = $this->catalog->find($productId);
            if (!$product) {
                continue;
            }

            $price = (float) ($product['price'] ?? 0);
            $lineTotal = $price * $qty;

            $lineItems[] = [
                'id' => $productId,
                'product_id' => $productId,
                'name' => $product['name'] ?? '',
                'price' => $price,
                'quantity' => $qty,
                'line_total' => $lineTotal,
                'image' => $product['image'] ?? null,
                'url' => $product['url'] ?? null,
            ];

            $subtotal += $lineTotal;
        }

        $pricing = $this->pricing->summarize($subtotal, null, 'standard');

        $response = response()->json([
            'cart_token' => $token,
            'items' => $lineItems,
            'subtotal' => round($subtotal, 2),
            'shipping' => $pricing['shipping'],
            'tax' => $pricing['tax'],
            'total' => $pricing['total'],
        ], $status);

        return $response->header('X-Cart-Token', $token);
    }

    private function token(Request $request): ?string
    {
        $token = $request->header('X-Cart-Token')
            ?? $request->query('cart_token')
            ?? $request->input('cart_token');

        $token = is_string($token) ? trim($token) : null;
        return $token !== '' ? $token : null;
    }
}
