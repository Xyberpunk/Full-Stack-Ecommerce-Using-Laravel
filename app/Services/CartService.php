<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CartService
{
    public function __construct(
        private readonly CatalogService $catalog,
    ) {
    }

    /**
     * @return array{token: string, items: array<string, int>}
     */
    public function load(?int $userId, ?string $token): array
    {
        if (!$this->hasPersistentTables()) {
            return $this->loadFromCache($token);
        }

        $cart = $this->resolveCart($userId, $token);

        return [
            'token' => $cart->token,
            'items' => $cart->items()
                ->pluck('quantity', 'product_id')
                ->mapWithKeys(fn ($quantity, $productId) => [(string) $productId => (int) $quantity])
                ->all(),
        ];
    }

    /**
     * @return array{token: string, items: array<string, int>}
     */
    public function add(?int $userId, ?string $token, string $productId, int $quantity): array
    {
        if (!$this->hasPersistentTables()) {
            return $this->addToCache($token, $productId, $quantity);
        }

        $cart = $this->resolveCart($userId, $token);
        $item = $cart->items()->firstOrCreate(['product_id' => $productId], ['quantity' => 0]);
        $item->update(['quantity' => $item->quantity + max(1, $quantity)]);

        return $this->load($userId, $cart->token);
    }

    /**
     * @return array{token: string, items: array<string, int>}
     */
    public function setQty(?int $userId, ?string $token, string $productId, int $quantity): array
    {
        if (!$this->hasPersistentTables()) {
            return $this->setQtyInCache($token, $productId, $quantity);
        }

        $cart = $this->resolveCart($userId, $token);

        $cart->items()->updateOrCreate(
            ['product_id' => $productId],
            ['quantity' => max(1, $quantity)],
        );

        return $this->load($userId, $cart->token);
    }

    /**
     * @return array{token: string, items: array<string, int>}
     */
    public function remove(?int $userId, ?string $token, string $productId): array
    {
        if (!$this->hasPersistentTables()) {
            return $this->removeFromCache($token, $productId);
        }

        $cart = $this->resolveCart($userId, $token);
        $cart->items()->where('product_id', $productId)->delete();

        return $this->load($userId, $cart->token);
    }

    /**
     * @return array{token: string, items: array<string, int>}
     */
    public function clear(?int $userId, ?string $token): array
    {
        if (!$this->hasPersistentTables()) {
            return $this->clearCacheCart($token);
        }

        $cart = $this->resolveCart($userId, $token);
        $cart->items()->delete();

        return ['token' => $cart->token, 'items' => []];
    }

    private function resolveCart(?int $userId, ?string $token): Cart
    {
        if ($userId) {
            $userCart = Cart::firstOrCreate(
                ['user_id' => $userId],
                ['token' => (string) Str::uuid()],
            );

            if ($token && $token !== $userCart->token) {
                $guestCart = Cart::where('token', $token)
                    ->whereNull('user_id')
                    ->with('items')
                    ->first();

                if ($guestCart) {
                    foreach ($guestCart->items as $guestItem) {
                        $existing = $userCart->items()->firstOrCreate(
                            ['product_id' => $guestItem->product_id],
                            ['quantity' => 0],
                        );

                        $existing->update([
                            'quantity' => $existing->quantity + $guestItem->quantity,
                        ]);
                    }

                    $guestCart->delete();
                }
            }

            return $userCart;
        }

        $token = $token ?: (string) Str::uuid();

        return Cart::firstOrCreate(
            ['token' => $token],
            ['user_id' => null],
        );
    }

    private function hasPersistentTables(): bool
    {
        return Schema::hasTable('carts') && Schema::hasTable('cart_items');
    }

    /**
     * @return array{token: string, items: array<string, int>}
     */
    private function loadFromCache(?string $token): array
    {
        $token = $token ?: (string) Str::uuid();

        $key = $this->cacheKey($token);
        $store = Cache::store('file');
        $cart = $store->get($key);

        if (!is_array($cart) || !isset($cart['items']) || !is_array($cart['items'])) {
            $cart = ['token' => $token, 'items' => []];
            $store->put($key, $cart, now()->addDays(7));
        }

        return [
            'token' => $token,
            'items' => $this->normalizeItems($cart['items']),
        ];
    }

    /**
     * @return array{token: string, items: array<string, int>}
     */
    private function addToCache(?string $token, string $productId, int $quantity): array
    {
        $cart = $this->loadFromCache($token);
        $cart['items'][$productId] = ($cart['items'][$productId] ?? 0) + max(1, $quantity);
        $this->saveCacheCart($cart['token'], $cart['items']);

        return $cart;
    }

    /**
     * @return array{token: string, items: array<string, int>}
     */
    private function setQtyInCache(?string $token, string $productId, int $quantity): array
    {
        $cart = $this->loadFromCache($token);
        $cart['items'][$productId] = max(1, $quantity);
        $this->saveCacheCart($cart['token'], $cart['items']);

        return $cart;
    }

    /**
     * @return array{token: string, items: array<string, int>}
     */
    private function removeFromCache(?string $token, string $productId): array
    {
        $cart = $this->loadFromCache($token);
        unset($cart['items'][$productId]);
        $this->saveCacheCart($cart['token'], $cart['items']);

        return $cart;
    }

    /**
     * @return array{token: string, items: array<string, int>}
     */
    private function clearCacheCart(?string $token): array
    {
        $cart = $this->loadFromCache($token);
        $this->saveCacheCart($cart['token'], []);

        return ['token' => $cart['token'], 'items' => []];
    }

    /**
     * @param  array<string, int>  $items
     */
    private function saveCacheCart(string $token, array $items): void
    {
        Cache::store('file')->put($this->cacheKey($token), [
            'token' => $token,
            'items' => $this->normalizeItems($items),
        ], now()->addDays(7));
    }

    /**
     * @param  array<string, mixed>  $items
     * @return array<string, int>
     */
    private function normalizeItems(array $items): array
    {
        $out = [];

        foreach ($items as $productId => $qty) {
            $pid = (string) $productId;
            $quantity = max(1, (int) $qty);

            if ($this->catalog->find($pid) !== null) {
                $out[$pid] = $quantity;
            }
        }

        return $out;
    }

    private function cacheKey(string $token): string
    {
        return 'cart:' . $token;
    }
}
