<?php

namespace App\Services;

use App\Models\Product;

class CatalogService
{
    /**
     * @return array<int, array<string, mixed>>
     */
    public function all(): array
    {
        return Product::with('category')
            ->where('is_active', true)
            ->orderByDesc('is_featured')
            ->latest()
            ->get()
            ->map(fn (Product $product) => $this->transform($product))
            ->all();
    }

    /**
     * @return array<string, mixed>|null
     */
    public function find(string $productId): ?array
    {
        $product = Product::with('category')
            ->whereKey($productId)
            ->where('is_active', true)
            ->first();

        return $product ? $this->transform($product) : null;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function featured(): array
    {
        return Product::with('category')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->limit(8)
            ->get()
            ->map(fn (Product $product) => $this->transform($product))
            ->all();
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function trending(): array
    {
        return Product::with('category')
            ->where('is_active', true)
            ->latest()
            ->limit(8)
            ->get()
            ->map(fn (Product $product) => $this->transform($product))
            ->all();
    }

    /**
     * @return array<string, mixed>
     */
    private function transform(Product $product): array
    {
        return [
            'id' => (string) $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'description' => $product->description,
            'price' => (float) $product->price,
            'stock' => (int) $product->stock,
            'image' => $product->image_path ? asset($product->image_path) : null,
            'url' => route('product.show', $product),
            'category' => $product->category?->name,
            'category_slug' => $product->category?->slug,
            'is_featured' => (bool) $product->is_featured,
        ];
    }
}
