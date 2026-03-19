@extends('layouts.storefront')

@section('body_attributes') class="bg-body" data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%"
  data-bs-smooth-scroll="true" tabindex="0"@endsection

@section('page_title', 'Blog Details')

@section('storefront_content')
<div class="post-wrap padding-medium overflow-hidden">
  <div class="container">
    <div class="row">
      <main>
        <div class="row">
          <article class="post-item">
            <div class="post-content">
              <div class="post-meta text-uppercase">
                <span class="post-category">{{ optional($post->published_at)->format('F d, Y') ?: $post->created_at->format('F d, Y') }}</span>
                <span class="meta-date"> / {{ $post->author?->name ?? 'Rural Team' }}</span>
              </div>
              <h1 class="display-1">{{ $post->title }}</h1>
              <div class="hero-image col-lg-12 mt-5">
                <img
                  src="{{ asset($post->featured_image ?: 'assets/images/single-post-item.jpg') }}"
                  alt="{{ $post->title }}"
                  class="img-fluid"
                >
              </div>
              <div class="post-description padding-medium">
                @if($post->excerpt)
                  <p><strong>{{ $post->excerpt }}</strong></p>
                @endif
                {!! nl2br(e($post->content)) !!}
              </div>
            </div>
          </article>
        </div>

        @if($relatedPosts->isNotEmpty())
          <div class="row mt-5">
            <div class="col-12">
              <h3 class="text-dark mb-4">Related Posts</h3>
            </div>
            @foreach($relatedPosts as $relatedPost)
              <div class="col-lg-4 col-md-6 mb-4">
                <div class="card-item">
                  <div class="card border-0 bg-transparent">
                    <div class="card-image image-zoom-effect">
                      <a href="{{ route('blog.show', $relatedPost) }}">
                        <img
                          src="{{ asset($relatedPost->featured_image ?: 'assets/images/post-item1.jpg') }}"
                          alt="{{ $relatedPost->title }}"
                          class="post-image img-fluid"
                        >
                      </a>
                    </div>
                  </div>
                  <div class="card-body p-0 mt-4">
                    <h3 class="card-title text-capitalize">
                      <a href="{{ route('blog.show', $relatedPost) }}">{{ $relatedPost->title }}</a>
                    </h3>
                    <p>{{ $relatedPost->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($relatedPost->content), 120) }}</p>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @endif
      </main>
    </div>
  </div>
</div>
@endsection
