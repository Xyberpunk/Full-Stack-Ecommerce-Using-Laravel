@extends('layouts.storefront')

@section('body_attributes') class="bg-body" data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%"
  data-bs-smooth-scroll="true" tabindex="0"@endsection

@section('page_title', 'Blog')

@section('storefront_content')
<div class="post-wrap">
  <div class="container-fluid">
    <div class="row">
      <main class="post-list post-card-small">
        <div class="row post-grid">
          @forelse($posts as $post)
            <div class="col-lg-3 col-md-6 col-sm-12 mb-5">
              <div class="card-item">
                <div class="card border-0 bg-transparent">
                  <div class="card-image image-zoom-effect">
                    <a href="{{ route('blog.show', $post) }}">
                      <img
                        src="{{ asset($post->featured_image ?: 'assets/images/post-item1.jpg') }}"
                        alt="{{ $post->title }}"
                        class="post-image img-fluid"
                      >
                    </a>
                  </div>
                </div>
                <div class="card-body p-0 mt-4">
                  <div class="post-meta text-uppercase text-black-50 small mb-2">
                    <span>{{ optional($post->published_at)->format('F d, Y') ?: $post->created_at->format('F d, Y') }}</span>
                    <span> / {{ $post->author?->name ?? 'Rural Team' }}</span>
                  </div>
                  <h3 class="card-title text-capitalize">
                    <a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a>
                  </h3>
                  <p>
                    {{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 140) }}
                    <span>
                      <a href="{{ route('blog.show', $post) }}" class="text-decoration-underline text-black-50 text-capitalize p-0">
                        <em>Read More</em>
                      </a>
                    </span>
                  </p>
                </div>
              </div>
            </div>
          @empty
            <div class="col-12">
              <div class="border rounded-3 p-5 text-center bg-white">
                <h3 class="h4 mb-3">No blog posts published yet</h3>
                <p class="text-muted mb-0">Published articles from the admin panel will appear here.</p>
              </div>
            </div>
          @endforelse
        </div>

        <nav aria-label="Page navigation" class="d-flex justify-content-center mt-5">
          {{ $posts->links() }}
        </nav>
      </main>
    </div>
  </div>
</div>
@endsection
