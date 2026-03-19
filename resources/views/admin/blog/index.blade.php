@extends('layouts.admin')

@section('content')
    <div class="panel-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Blog Posts</h5>
            <a href="/admin/blog/create" class="btn btn-primary">New Post</a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>Image</th><th>Title</th><th>Author</th><th>Status</th><th>Published At</th><th class="text-end">Actions</th></tr></thead>
                <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td>
                            <img src="{{ asset($post->featured_image ?: 'assets/images/post-item1.jpg') }}" alt="{{ $post->title }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 10px;">
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->author?->name ?? 'Unknown' }}</td>
                        <td>{{ $post->is_published ? 'Published' : 'Draft' }}</td>
                        <td>{{ $post->published_at?->format('d M Y H:i') ?? '-' }}</td>
                        <td class="text-end">
                            <a href="/admin/blog/{{ $post->id }}/edit" class="btn btn-sm btn-outline-dark">Edit</a>
                            <form method="POST" action="/admin/blog/{{ $post->id }}" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete post?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-muted">No blog posts found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $posts->links() }}
    </div>
@endsection
