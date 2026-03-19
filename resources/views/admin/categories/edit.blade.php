@extends('layouts.admin')

@section('content')
    <div class="panel-card">
        <h5 class="mb-3">Edit Category</h5>
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @method('PUT')
            @include('admin.categories._form', ['submitLabel' => 'Update Category'])
        </form>
    </div>
@endsection
