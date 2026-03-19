@extends('layouts.admin')

@section('content')
    <div class="panel-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Products</h5>
            <a href="/admin/products/create" class="btn btn-primary">Add Product</a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                <tr><th>Image</th><th>Name</th><th>SKU</th><th>Price</th><th>Stock</th><th>Status</th><th>Category</th><th class="text-end">Actions</th></tr>
                </thead>
                <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>
                            <img src="{{ asset($product->image_path ?: 'assets/images/product-item1.jpg') }}" alt="{{ $product->name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 10px;">
                        </td>
                        <td>
                            <div>{{ $product->name }}</div>
                            @if($product->isLowStock())
                                <small class="text-danger">Low stock alert</small>
                            @endif
                        </td>
                        <td>{{ $product->sku ?: '-' }}</td>
                        <td>${{ number_format((float)$product->price, 2) }}</td>
                        <td>{{ $product->stock }} / alert {{ $product->low_stock_threshold }}</td>
                        <td>{{ $product->is_active ? 'Active' : 'Inactive' }}</td>
                        <td>{{ $product->category?->name ?? '-' }}</td>
                        <td class="text-end">
                            <a href="/admin/products/{{ $product->id }}/edit" class="btn btn-sm btn-outline-dark">Edit</a>
                            <form method="POST" action="/admin/products/{{ $product->id }}" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete product?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-muted">No products found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $products->links() }}
    </div>
@endsection
