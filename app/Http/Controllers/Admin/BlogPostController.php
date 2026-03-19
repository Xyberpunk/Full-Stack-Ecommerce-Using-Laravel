<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogPostStoreRequest;
use App\Http\Requests\Admin\BlogPostUpdateRequest;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('author')->latest()->paginate(15);
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(BlogPostStoreRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']) . '-' . Str::lower(Str::random(6));
        $data['user_id'] = auth()->id();
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;
        $data['featured_image'] = $this->storeImage($request, $data['featured_image'] ?? null);

        BlogPost::create($data);

        return redirect()->route('admin.blog.index')->with('status', 'Blog post created.');
    }

    public function edit(BlogPost $blog)
    {
        return view('admin.blog.edit', ['post' => $blog]);
    }

    public function update(BlogPostUpdateRequest $request, BlogPost $blog)
    {
        $data = $request->validated();
        $data['is_published'] = $request->boolean('is_published');

        if (($data['title'] ?? '') !== $blog->title) {
            $data['slug'] = Str::slug($data['title']) . '-' . Str::lower(Str::random(6));
        }

        if ($data['is_published'] && !$blog->published_at) {
            $data['published_at'] = now();
        }

        if (!$data['is_published']) {
            $data['published_at'] = null;
        }

        $data['featured_image'] = $this->storeImage($request, $data['featured_image'] ?? $blog->featured_image, $blog->featured_image);

        $blog->update($data);
        return redirect()->route('admin.blog.index')->with('status', 'Blog post updated.');
    }

    public function destroy(BlogPost $blog)
    {
        if ($blog->featured_image && str_starts_with($blog->featured_image, 'storage/')) {
            Storage::disk('public')->delete(Str::after($blog->featured_image, 'storage/'));
        }

        $blog->delete();
        return redirect()->route('admin.blog.index')->with('status', 'Blog post deleted.');
    }

    private function storeImage(BlogPostStoreRequest $request, ?string $imagePath, ?string $previousImagePath = null): ?string
    {
        if (!$request->hasFile('image')) {
            return $imagePath;
        }

        if ($previousImagePath && str_starts_with($previousImagePath, 'storage/')) {
            Storage::disk('public')->delete(Str::after($previousImagePath, 'storage/'));
        }

        return 'storage/' . $request->file('image')->store('blog-posts', 'public');
    }
}
