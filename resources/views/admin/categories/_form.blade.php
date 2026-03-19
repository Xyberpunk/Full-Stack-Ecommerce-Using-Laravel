@csrf
<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label">Category Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $category->name ?? '') }}" required>
    </div>
    <div class="col-12">
        <button class="btn btn-primary">{{ $submitLabel }}</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-dark">Cancel</a>
    </div>
</div>
