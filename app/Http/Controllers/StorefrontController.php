<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StorefrontController extends Controller
{
    public function home(): View
    {
        $featuredProducts = $this->productsBySlug([
            'classic-cotton-t-shirt',
            'oversized-hoodie',
            'vintage-graphic-tee',
            'minimalist-hoodie',
            'striped-long-sleeve-tee',
            'relaxed-fit-hoodie',
        ]);

        $trendingProducts = $this->productsBySlug([
            'classic-black-hoodie',
            'graphic-print-t-shirt',
            'oversized-hoodie-2',
            'minimalist-cotton-t-shirt',
            'vintage-washed-hoodie',
            'striped-casual-t-shirt',
        ]);

        return view('user.index', [
            'featuredProducts' => $featuredProducts,
            'trendingProducts' => $trendingProducts,
            'wishlistProductIds' => $this->wishlistProductIds(),
        ]);
    }

    public function shop(Request $request): View
    {
        $products = Product::with('category')
            ->where('is_active', true)
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', fn ($categoryQuery) => $categoryQuery->where('slug', $request->string('category')));
            })
            ->when($request->filled('q'), function ($query) use ($request) {
                $term = $request->string('q')->toString();
                $query->where(function ($searchQuery) use ($term) {
                    $searchQuery
                        ->where('name', 'like', "%{$term}%")
                        ->orWhere('description', 'like', "%{$term}%");
                });
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('user.shop-sidebar', [
            'products' => $products,
            'categories' => $categories,
            'wishlistProductIds' => $this->wishlistProductIds(),
        ]);
    }

    public function blog(): View
    {
        $posts = BlogPost::with('author')
            ->where('is_published', true)
            ->orderByDesc('published_at')
            ->latest()
            ->paginate(12);

        return view('user.blog-grid-four-column', compact('posts'));
    }

    public function latestBlogRedirect(): RedirectResponse
    {
        $post = BlogPost::where('is_published', true)
            ->orderByDesc('published_at')
            ->latest()
            ->firstOrFail();

        return redirect()->route('blog.show', $post);
    }

    public function blogShow(BlogPost $blog): View
    {
        abort_unless($blog->is_published, 404);

        $relatedPosts = BlogPost::where('is_published', true)
            ->whereKeyNot($blog->id)
            ->orderByDesc('published_at')
            ->latest()
            ->limit(3)
            ->get();

        return view('user.single-post', [
            'post' => $blog,
            'relatedPosts' => $relatedPosts,
        ]);
    }

    public function featuredProductRedirect(): RedirectResponse
    {
        $product = Product::where('is_active', true)
            ->orderByDesc('is_featured')
            ->latest()
            ->firstOrFail();

        return redirect()->route('product.show', $product);
    }

    public function product(Product $product): View
    {
        abort_unless($product->is_active, 404);

        $relatedProducts = Product::with('category')
            ->where('is_active', true)
            ->whereKeyNot($product->id)
            ->when($product->category_id, fn ($query) => $query->where('category_id', $product->category_id))
            ->latest()
            ->limit(4)
            ->get();

        return view('user.single-product', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'wishlistProductIds' => $this->wishlistProductIds(),
        ]);
    }

    private function productsBySlug(array $slugs)
    {
        $products = Product::with('category')
            ->where('is_active', true)
            ->whereIn('slug', $slugs)
            ->get()
            ->keyBy('slug');

        return collect($slugs)
            ->map(fn (string $slug) => $products->get($slug))
            ->filter();
    }

    private function wishlistProductIds(): Collection
    {
        if (!auth()->check()) {
            return collect();
        }

        return auth()->user()->wishlistItems()->pluck('product_id');
    }
}
