<div class="swiper-slide">
  <div class="product-card image-zoom-effect link-effect d-flex flex-wrap">
    <div class="image-holder">
      <a href="{{ route('product.show', $product) }}">
        <img
          src="{{ asset($product->image_path ?: 'assets/images/product-item1.jpg') }}"
          alt="{{ $product->name }}"
          class="product-image img-fluid"
        />
      </a>
    </div>
    <div class="cart-concern">
      <h3 class="card-title text-capitalize pt-3">
        <a href="{{ route('product.show', $product) }}">{{ $product->name }}</a>
      </h3>
      <div class="product-rating" aria-label="Product category">
        <span class="count">{{ $product->category?->name ?? 'General' }}</span>
      </div>
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
      <div class="cart-info">
        <a
          class="pseudo-text-effect fw-bold"
          href="#"
          data-after="ADD TO CART"
          data-product-id="{{ $product->id }}"
        >
          <span>${{ number_format((float) $product->price, 2) }}</span>
        </a>
      </div>
    </div>
  </div>
</div>
