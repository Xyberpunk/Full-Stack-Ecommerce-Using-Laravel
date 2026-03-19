<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\InventoryService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct(
        private readonly InventoryService $inventory,
    ) {
    }

    public function index()
    {
        $products = Product::with('category')->latest()->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();
        $openingStock = (int) $data['stock'];
        $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(6));
        $data['sku'] = $data['sku'] ?: 'SKU-' . strtoupper(Str::random(8));
        $data['is_active'] = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['image_path'] = $this->storeImage($request, $data['image_path'] ?? null);
        $data['stock'] = 0;

        $product = Product::create($data);

        if ($openingStock > 0) {
            $this->inventory->adjust(
                product: $product,
                quantityChange: $openingStock,
                type: 'received',
                adminUserId: $request->user()?->id,
                reference: $product->sku,
                note: 'Opening stock recorded on product creation.',
            );
        }

        return redirect()->route('admin.products.index')->with('status', 'Product created.');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        $previousStock = (int) $product->stock;
        $nextStock = (int) $data['stock'];
        $data['is_active'] = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');

        if (($data['name'] ?? '') !== $product->name) {
            $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(6));
        }

        if (empty($data['sku'])) {
            $data['sku'] = $product->sku ?: 'SKU-' . strtoupper(Str::random(8));
        }

        $data['image_path'] = $this->storeImage($request, $data['image_path'] ?? $product->image_path, $product->image_path);
        $data['stock'] = $previousStock;

        $product->update($data);

        $stockDelta = $nextStock - $previousStock;
        if ($stockDelta !== 0) {
            $this->inventory->adjust(
                product: $product->fresh(),
                quantityChange: $stockDelta,
                type: 'adjustment',
                adminUserId: $request->user()?->id,
                reference: $product->sku,
                note: 'Stock adjusted from admin product editor.',
            );
        }

        return redirect()->route('admin.products.index')->with('status', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        if ($product->image_path && str_starts_with($product->image_path, 'storage/')) {
            Storage::disk('public')->delete(Str::after($product->image_path, 'storage/'));
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('status', 'Product deleted.');
    }

    private function storeImage(ProductStoreRequest $request, ?string $imagePath, ?string $previousImagePath = null): ?string
    {
        if (!$request->hasFile('image')) {
            return $imagePath;
        }

        if ($previousImagePath && str_starts_with($previousImagePath, 'storage/')) {
            Storage::disk('public')->delete(Str::after($previousImagePath, 'storage/'));
        }

        return 'storage/' . $request->file('image')->store('products', 'public');
    }
}
