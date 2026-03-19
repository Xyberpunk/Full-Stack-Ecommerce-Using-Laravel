@extends('layouts.admin')

@section('content')
    <div class="panel-card">
        <h5 class="mb-3">Create Category</h5>
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @include('admin.categories._form', ['submitLabel' => 'Create Category'])
        </form>
    </div>
@endsection
