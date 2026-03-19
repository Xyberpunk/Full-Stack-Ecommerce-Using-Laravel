@csrf
<div class="row g-3">
    <div class="col-12">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $post->title ?? '') }}" required>
    </div>
    <div class="col-12">
        <label class="form-label">Excerpt</label>
        <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
    </div>
    <div class="col-12">
        <label class="form-label">Featured Image Path</label>
        <input type="text" name="featured_image" class="form-control" value="{{ old('featured_image', $post->featured_image ?? '') }}" placeholder="assets/images/post-item1.jpg">
        <small class="text-muted d-block mt-1">Use a theme asset path or upload a file below.</small>
    </div>
    <div class="col-12">
        <label class="form-label">Upload Featured Image</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        @if(!empty($post?->featured_image))
            <div class="mt-2">
                <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" style="max-width: 120px; border-radius: 10px;">
            </div>
        @endif
    </div>
    <div class="col-12">
        <label class="form-label">Content</label>
        <textarea name="content" class="form-control" rows="12" required>{{ old('content', $post->content ?? '') }}</textarea>
    </div>
    <div class="col-12">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="is_published" value="1" id="is-published" @checked(old('is_published', $post->is_published ?? false))>
            <label class="form-check-label" for="is-published">Publish now</label>
        </div>
    </div>
    <div class="col-12">
        <button class="btn btn-primary">{{ $submitLabel }}</button>
        <a href="/admin/blog" class="btn btn-outline-dark">Cancel</a>
    </div>
</div>
