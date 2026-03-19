@csrf
<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label">Product Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-control">
            <option value="">No category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected((string)old('category_id', $product->category_id ?? '') === (string)$category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label">SKU</label>
        <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku ?? '') }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">Price</label>
        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price ?? '0.00') }}" required>
    </div>
    <div class="col-md-3">
        <label class="form-label">Stock</label>
        <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock ?? 0) }}" required>
    </div>
    <div class="col-md-3">
        <label class="form-label">Low Stock Alert At</label>
        <input type="number" name="low_stock_threshold" class="form-control" value="{{ old('low_stock_threshold', $product->low_stock_threshold ?? 5) }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Image Path</label>
        <input type="text" name="image_path" class="form-control" value="{{ old('image_path', $product->image_path ?? '') }}" placeholder="assets/images/product-item1.jpg">
        <small class="text-muted d-block mt-1">Keep this for existing theme assets, or upload a new file below.</small>
    </div>
    <div class="col-md-3">
        <label class="form-label">Upload Product Image</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        @if(!empty($product?->image_path))
            <div class="mt-2">
                <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" style="max-width: 96px; border-radius: 10px;">
            </div>
        @endif
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="5">{{ old('description', $product->description ?? '') }}</textarea>
    </div>
    <div class="col-md-3">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="is_active" value="1" id="is-active" @checked(old('is_active', $product->is_active ?? true))>
            <label class="form-check-label" for="is-active">Active</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="is_featured" value="1" id="is-featured" @checked(old('is_featured', $product->is_featured ?? false))>
            <label class="form-check-label" for="is-featured">Featured</label>
        </div>
    </div>
    <div class="col-12">
        <button class="btn btn-primary">{{ $submitLabel }}</button>
        <a href="/admin/products" class="btn btn-outline-dark">Cancel</a>
    </div>
</div>
