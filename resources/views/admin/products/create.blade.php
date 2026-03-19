@extends('layouts.admin')

@section('content')
    <div class="panel-card">
        <h5 class="mb-3">Create Product</h5>
        <form method="POST" action="/admin/products" enctype="multipart/form-data">
            @include('admin.products._form', ['submitLabel' => 'Create Product'])
        </form>
    </div>
@endsection
