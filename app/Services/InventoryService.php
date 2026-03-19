<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Validation\ValidationException;

class InventoryService
{
    public function assertInStock(Product $product, int $quantity): void
    {
        if ($quantity > $product->stock) {
            throw ValidationException::withMessages([
                'cart' => "{$product->name} only has {$product->stock} item(s) left in stock.",
            ]);
        }
    }

    public function decreaseForOrder(Order $order, ?int $adminUserId = null): void
    {
        $order->loadMissing('items.product');

        foreach ($order->items as $item) {
            $product = $item->product;
            if (!$product) {
                continue;
            }

            $this->assertInStock($product, (int) $item->quantity);
            $this->adjust(
                product: $product,
                quantityChange: -1 * (int) $item->quantity,
                type: 'sale',
                orderId: $order->id,
                adminUserId: $adminUserId,
                reference: $order->order_number,
                note: 'Stock reduced after checkout.',
            );
        }
    }

    public function restoreForOrder(Order $order, ?int $adminUserId = null, string $note = 'Stock restored after order cancellation.'): void
    {
        $order->loadMissing('items.product');

        foreach ($order->items as $item) {
            $product = $item->product;
            if (!$product) {
                continue;
            }

            $this->adjust(
                product: $product,
                quantityChange: (int) $item->quantity,
                type: 'cancelled_return',
                orderId: $order->id,
                adminUserId: $adminUserId,
                reference: $order->order_number,
                note: $note,
            );
        }
    }

    public function adjust(
        Product $product,
        int $quantityChange,
        string $type,
        ?int $orderId = null,
        ?int $adminUserId = null,
        ?string $reference = null,
        ?string $note = null,
    ): Product {
        $before = (int) $product->stock;
        $after = max(0, $before + $quantityChange);

        $product->update(['stock' => $after]);

        $product->stockMovements()->create([
            'order_id' => $orderId,
            'admin_user_id' => $adminUserId,
            'type' => $type,
            'quantity_change' => $quantityChange,
            'stock_before' => $before,
            'stock_after' => $after,
            'reference' => $reference,
            'note' => $note,
        ]);

        return $product->fresh();
    }
}
