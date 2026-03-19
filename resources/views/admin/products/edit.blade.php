@extends('layouts.admin')

@section('content')
    <div class="panel-card">
        <h5 class="mb-3">Edit Product</h5>
        <form method="POST" action="/admin/products/{{ $product->id }}" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.products._form', ['submitLabel' => 'Update Product'])
        </form>
    </div>
@endsection
