@extends('layouts.admin')

@section('content')
    <div class="panel-card">
        <h5 class="mb-3">Create Blog Post</h5>
        <form method="POST" action="/admin/blog" enctype="multipart/form-data">
            @include('admin.blog._form', ['submitLabel' => 'Create Post'])
        </form>
    </div>
@endsection
