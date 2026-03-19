@extends('layouts.storefront')

@section('body_attributes') class="bg-body" data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%"
  data-bs-smooth-scroll="true" tabindex="0"@endsection

@section('page_title', 'Wishlist')

@section('storefront_content')
<section id="Wishlist" class="pt-5 ">
    <div class="container-fluid">
      @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
      @endif

      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h2 class="section-title text-uppercase mb-2">Saved Wishlist</h2>
          <p class="mb-0 text-muted">Products you have saved for later are stored in your account.</p>
        </div>
        <a href="{{ route('account') }}" class="btn btn-outline-dark text-uppercase">Back to Account</a>
      </div>

      @if($wishlistItems->isNotEmpty())
        <div class="row text-dark border-bottom py-3">
          <div class="col-lg-4 text-uppercase"><strong>Product</strong></div>
          <div class="col-lg-2 text-uppercase"><strong>Category</strong></div>
          <div class="col-lg-2 text-uppercase"><strong>Unit Price</strong></div>
          <div class="col-lg-2 text-uppercase"><strong>Stock Status</strong></div>
          <div class="col-lg-2 text-uppercase"><strong>Action</strong></div>
        </div>

        <div class="product-wrapper">
          @foreach($wishlistItems as $wishlistItem)
            <div class="product-item row align-items-center mb-4 py-3 border-bottom">
              <div class="col-lg-1 col-md-2 d-flex align-items-center mb-3 mb-lg-0">
                <img
                  src="{{ asset($wishlistItem->product->image_path ?: 'assets/images/product-item1.jpg') }}"
                  alt="{{ $wishlistItem->product->name }}"
                  class="img-fluid"
                >
              </div>
              <div class="col-lg-3 col-md-4 mb-3 mb-lg-0">
                <h3 class="item-title text-uppercase fs-5 mb-1">{{ $wishlistItem->product->name }}</h3>
                <small class="text-muted">Added {{ $wishlistItem->created_at->format('M d, Y') }}</small>
              </div>
              <div class="col-lg-2 col-md-2 mb-3 mb-lg-0">
                <span>{{ $wishlistItem->product->category?->name ?? 'Uncategorized' }}</span>
              </div>
              <div class="col-lg-2 col-md-2 product-price mb-3 mb-lg-0">
                <span class="item-price">${{ number_format((float) $wishlistItem->product->price, 2) }}</span>
              </div>
              <div class="col-lg-2 col-md-2 wishlist-stock mb-3 mb-lg-0">
                <span class="item-stock">{{ $wishlistItem->product->stock > 0 ? 'In Stock' : 'Out of Stock' }}</span>
              </div>
              <div class="col-lg-2 col-md-12">
                <form method="POST" action="{{ route('account.wishlist.destroy', $wishlistItem) }}">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-outline-dark text-uppercase">Remove</button>
                </form>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <div class="border rounded-3 p-5 text-center bg-white">
          <h3 class="h4 mb-3">Your wishlist is empty</h3>
          <p class="text-muted mb-4">Save products here to compare and buy them later.</p>
          <a href="/shop" class="btn btn-dark text-uppercase">Browse Products</a>
        </div>
      @endif
    </div>
  </section>
@endsection
