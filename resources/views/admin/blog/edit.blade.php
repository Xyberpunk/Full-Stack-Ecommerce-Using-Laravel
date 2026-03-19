@extends('layouts.admin')

@section('content')
    <div class="panel-card">
        <h5 class="mb-3">Edit Blog Post</h5>
        <form method="POST" action="/admin/blog/{{ $post->id }}" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.blog._form', ['submitLabel' => 'Update Post'])
        </form>
    </div>
@endsection
