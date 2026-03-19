@extends('layouts.storefront')

@section('body_attributes') class="bg-body"
    data-bs-spy="scroll"
    data-bs-target="#navbar"
    data-bs-root-margin="0px 0px -40%"
    data-bs-smooth-scroll="true"
    tabindex="0"@endsection

@section('page_title', 'Shop')

@section('storefront_content')
<section class="product-grid py-5">
      <div class="container-fluid">
        <div class="row flex-row-reverse g-md-5">
          <main class="col-md-9 col-sm-12">
            <div class="filter-shop d-flex justify-content-between">
              <div class="showing-product">
                <p>Showing {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} of {{ $products->total() }} results</p>
              </div>
            </div>

            <div class="row">
              @forelse($products as $product)
                <div class="col-md-4 mb-5 product-item link-effect">
                  <div class="image-holder position-relative">
                    <a href="{{ route('product.show', $product) }}">
                      <img
                        src="{{ asset($product->image_path ?: 'assets/images/product-item1.jpg') }}"
                        alt="{{ $product->name }}"
                        class="product-image img-fluid"
                    /></a>

                    <div class="product-content">
                      <h3 class="card-title text-capitalize pt-3">
                        <a href="{{ route('product.show', $product) }}">{{ $product->name }}</a>
                      </h3>
                      <div class="mb-2">
                        @auth
                          @if(($wishlistProductIds ?? collect())->contains($product->id))
                            <form method="POST" action="{{ route('account.wishlist.destroy-product', $product) }}">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-outline-dark text-uppercase">Remove Wishlist</button>
                            </form>
                          @else
                            <form method="POST" action="{{ route('account.wishlist.store', $product) }}">
                              @csrf
                              <button type="submit" class="btn btn-sm btn-outline-dark text-uppercase">Add Wishlist</button>
                            </form>
                          @endif
                        @else
                          <a href="{{ route('account') }}" class="btn btn-sm btn-outline-dark text-uppercase">Wishlist</a>
                        @endauth
                      </div>
                      <a
                        href="#"
                        class="text-decoration-none fw-bold"
                        data-after="Add to cart"
                        data-product-id="{{ $product->id }}"
                      >
                        <span>${{ number_format((float) $product->price, 2) }}</span></a
                      >
                    </div>
                  </div>
                </div>
              @empty
                <div class="col-12">
                  <div class="border rounded-3 p-5 text-center bg-white">
                    <h3 class="h4 mb-3">No products found</h3>
                    <p class="text-muted mb-0">Try a different search or category filter.</p>
                  </div>
                </div>
              @endforelse
            </div>

            <nav aria-label="Page navigation" class="d-flex justify-content-center mt-5">
              {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
            </nav>
          </main>

          <aside class="col-md-3 col-sm-12 mt-5">
            <div class="sidebar">
              <div class="widget-menu">
                <div class="widget-search-bar">
                  <form role="search" method="get" class="d-flex">
                    <input
                      name="q"
                      value="{{ request('q') }}"
                      class="form-control search-field ps-3 bg-transparent"
                      placeholder="Search"
                      type="search"
                    />
                    <div class="search-icon bg-primary d-flex justify-content-center align-items-center">
                      <button type="submit" class="border-0 bg-transparent p-0">
                        <svg class="search text-light" width="20" height="20">
                          <use xlink:href="#search"></use></svg
                        >
                      </button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="widget-product-categories mt-3">
                <h5 class="widget-title text-decoration-underline">
                  Categories
                </h5>
                <ul class="product-categories list-unstyled text-hover">
                  <li class="cat-item">
                    <a href="{{ route('shop') }}">All Products</a>
                  </li>
                  @foreach($categories as $category)
                    <li class="cat-item">
                      <a href="{{ route('shop', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                    </li>
                  @endforeach
                </ul>
              </div>
              <div class="widget-product-brands pt-3">
                <h5 class="widget-title text-decoration-underline">Tags</h5>
                <ul class="product-tags list-unstyled text-hover">
                  <li class="tags-item">
                    <a href="/shop">Casual Wear</a>
                  </li>
                  <li class="tags-item">
                    <a href="/shop">Street Style</a>
                  </li>
                  <li class="tags-item">
                    <a href="/shop">Oversized Fit</a>
                  </li>
                  <li class="tags-item">
                    <a href="/shop">Cotton Fabric</a>
                  </li>
                  <li class="tags-item">
                    <a href="/shop">Trendy Designs</a>
                  </li>
                </ul>
              </div>

              <div class="widget-price-filter pt-3">
                <h5 class="widget-titlewidget-title text-decoration-underline">
                  Filter By Price
                </h5>
                <ul class="product-tags list-unstyled text-hover">
                  <li class="tags-item">
                    <a href="/shop">Less than $10</a>
                  </li>
                  <li class="tags-item">
                    <a href="/shop">$10- $20</a>
                  </li>
                  <li class="tags-item">
                    <a href="/shop">$20- $30</a>
                  </li>
                  <li class="tags-item">
                    <a href="/shop">$30- $40</a>
                  </li>
                  <li class="tags-item">
                    <a href="/shop">$40- $50</a>
                  </li>
                </ul>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </section>
@endsection
