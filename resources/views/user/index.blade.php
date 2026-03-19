@extends('layouts.user')

@section('body_attributes')
    class="bg-body"
    data-bs-spy="scroll"
    data-bs-target="#navbar"
    data-bs-root-margin="0px 0px -40%"
    data-bs-smooth-scroll="true"
    tabindex="0"
  @endsection

@section('content')
<svg xmlns="http://www.w3.org/2000/svg" style="display: none">
      <symbol
        id="search"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 32 32"
      >
        <title>Search</title>
        <path
          fill="currentColor"
          d="M19 3C13.488 3 9 7.488 9 13c0 2.395.84 4.59 2.25 6.313L3.281 27.28l1.439 1.44l7.968-7.969A9.922 9.922 0 0 0 19 23c5.512 0 10-4.488 10-10S24.512 3 19 3zm0 2c4.43 0 8 3.57 8 8s-3.57 8-8 8s-8-3.57-8-8s3.57-8 8-8z"
        />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="user" viewBox="0 0 16 16">
        <path
          d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
        />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="cart" viewBox="0 0 16 16">
        <path
          d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"
        />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="arrow-left"
        viewBox="0 0 32 32"
      >
        <path
          fill="currentColor"
          d="m13.281 6.781l-8.5 8.5l-.687.719l.687.719l8.5 8.5l1.438-1.438L7.938 17H28v-2H7.937l6.782-6.781z"
        />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="arrow-right"
        viewBox="0 0 32 32"
      >
        <path
          fill="currentColor"
          d="M18.719 6.781L17.28 8.22L24.063 15H4v2h20.063l-6.782 6.781l1.438 1.438l8.5-8.5l.687-.719l-.687-.719z"
        />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="shipping-fast"
        viewBox="0 0 32 32"
      >
        <path
          fill="currentColor"
          d="M0 6v2h19v15h-6.156c-.446-1.719-1.992-3-3.844-3c-1.852 0-3.398 1.281-3.844 3H4v-5H2v7h3.156c.446 1.719 1.992 3 3.844 3c1.852 0 3.398-1.281 3.844-3h8.312c.446 1.719 1.992 3 3.844 3c1.852 0 3.398-1.281 3.844-3H32v-8.156l-.063-.157l-2-6L29.72 10H21V6zm1 4v2h9v-2zm20 2h7.281L30 17.125V23h-1.156c-.446-1.719-1.992-3-3.844-3c-1.852 0-3.398 1.281-3.844 3H21zM2 14v2h6v-2zm7 8c1.117 0 2 .883 2 2s-.883 2-2 2s-2-.883-2-2s.883-2 2-2zm16 0c1.117 0 2 .883 2 2s-.883 2-2 2s-2-.883-2-2s.883-2 2-2z"
        />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="shopping-cart"
        viewBox="0 0 32 32"
      >
        <path
          fill="currentColor"
          d="M5 7c-.55 0-1 .45-1 1s.45 1 1 1h2.219l2.625 10.5c.222.89 1.02 1.5 1.937 1.5H23.25c.902 0 1.668-.598 1.906-1.469L27.75 10H11l.5 2h13.656l-1.906 7H11.781L9.156 8.5A1.983 1.983 0 0 0 7.22 7zm17 14c-1.645 0-3 1.355-3 3s1.355 3 3 3s3-1.355 3-3s-1.355-3-3-3zm-9 0c-1.645 0-3 1.355-3 3s1.355 3 3 3s3-1.355 3-3s-1.355-3-3-3zm0 2c.563 0 1 .438 1 1c0 .563-.438 1-1 1c-.563 0-1-.438-1-1c0-.563.438-1 1-1zm9 0c.563 0 1 .438 1 1c0 .563-.438 1-1 1c-.563 0-1-.438-1-1c0-.563.438-1 1-1z"
        />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="gift" viewBox="0 0 32 32">
        <path
          fill="currentColor"
          d="M12 5c-1.645 0-3 1.355-3 3c0 .352.074.684.188 1H4v6h1v13h22V15h1V9h-5.188A2.95 2.95 0 0 0 23 8c0-1.645-1.355-3-3-3c-1.75 0-2.938 1.328-3.719 2.438c-.105.148-.187.292-.281.437c-.094-.145-.176-.29-.281-.438C14.938 6.329 13.75 5 12 5zm0 2c.625 0 1.438.672 2.063 1.563c.152.218.128.23.25.437H12c-.566 0-1-.434-1-1c0-.566.434-1 1-1zm8 0c.566 0 1 .434 1 1c0 .566-.434 1-1 1h-2.313c.122-.207.098-.219.25-.438C18.563 7.673 19.375 7 20 7zM6 11h20v2h-9v-1h-2v1H6zm1 4h18v11h-8V16h-2v10H7z"
        />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="return"
        viewBox="0 0 32 32"
      >
        <path
          fill="currentColor"
          d="M16 3C8.832 3 3 8.832 3 16s5.832 13 13 13s13-5.832 13-13h-2c0 6.086-4.914 11-11 11S5 22.086 5 16S9.914 5 16 5c3.875 0 7.262 1.984 9.219 5H20v2h8V4h-2v3.719C23.617 4.844 20.02 3 16 3z"
        />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="quote" viewBox="0 0 24 24">
        <path
          fill="currentColor"
          d="m15 17l2-4h-4V6h7v7l-2 4h-3Zm-9 0l2-4H4V6h7v7l-2 4H6Z"
        />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="nav-icon"
        viewBox="0 0 16 16"
      >
        <path
          d="M14 10.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 .5-.5zm0-3a.5.5 0 0 0-.5-.5h-7a.5.5 0 0 0 0 1h7a.5.5 0 0 0 .5-.5zm0-3a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0 0 1h11a.5.5 0 0 0 .5-.5z"
        />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="close" viewBox="0 0 16 16">
        <path
          d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"
        />
      </symbol>
      <symbol
        xmlns="http://www.w3.org/2000/svg"
        id="navbar-icon"
        viewBox="0 0 16 16"
      >
        <path
          d="M14 10.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 .5-.5zm0-3a.5.5 0 0 0-.5-.5h-7a.5.5 0 0 0 0 1h7a.5.5 0 0 0 .5-.5zm0-3a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0 0 1h11a.5.5 0 0 0 .5-.5z"
        />
      </symbol>
    </svg>

    <div id="preloader">
      <span class="loader"></span>
    </div>

    <div class="search-box position-relative overflow-hidden w-100">
      <div class="search-wrap">
        <div class="close-button position-absolute">
          <svg class="close" width="22" height="22">
            <use xlink:href="#close"></use>
          </svg>
        </div>
        <form id="search-form" class="text-center pt-3" action="#" method="">
          <input
            type="text"
            class="search-input fs-5 p-4 bg-transparent"
            placeholder="Search..."
          />
          <svg class="search" width="22" height="22">
            <use xlink:href="#search"></use>
          </svg>
        </form>
      </div>
    </div>

    <header id="header" class="site-header text-black">
      <nav id="header-nav" class="navbar navbar-expand-lg px-md-3 py-md-4 py-3">
        <div class="container-fluid">
          <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/images/main-logo.png') }}" class="logo"
          /></a>
          <button
            class="navbar-toggler d-flex d-lg-none order-3 p-0"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#bdNavbar"
            aria-controls="bdNavbar"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <svg class="navbar-icon" width="50" height="50">
              <use xlink:href="#navbar-icon"></use>
            </svg>
          </button>
          <div
            class="offcanvas offcanvas-end"
            tabindex="-1"
            id="bdNavbar"
            aria-labelledby="bdNavbarOffcanvasLabel"
          >
            <div class="offcanvas-header px-4 pb-0">
              <a class="navbar-brand" href="/">
                <img src="{{ asset('assets/images/main-logo.png') }}" class="logo"
              /></a>
              <button
                type="button"
                class="btn-close btn-close-black"
                data-bs-dismiss="offcanvas"
                aria-label="Close"
                data-bs-target="#bdNavbar"
              ></button>
            </div>
            <div class="offcanvas-body">
              <ul
                id="navbar"
                class="navbar-nav text-capitalize justify-content-end align-items-center flex-grow-1 pe-3"
              >
                <li class="nav-item">
                  <a class="nav-link me-4 active" href="/">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-4" href="/about-us">About Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-4" href="/shop">Shop</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-4" href="/blog"
                    >Blog</a
                  >
                </li>
                @auth
@if(auth()->user()->isAdmin())
<li class="nav-item">
  <a class="nav-link me-4" href="{{ route('admin.dashboard') }}">Dashboard</a>
</li>
@endif
	@endauth
	@auth
	<li class="nav-item d-lg-none">
	  <form method="POST" action="{{ route('logout') }}" class="m-0">
	    @csrf
	    <button type="submit" class="nav-link me-4 logout-nav-btn">Logout</button>
	  </form>
	</li>
	@endauth
	<li class="nav-item">
	  <div class="user-items ps-5">
	    <ul class="d-flex justify-content-end list-unstyled">
	      <li class="search-item pe-3" data-bs-toggle="collapse" data-bs-target="#search-box" aria-controls="search-box" aria-expanded="false" aria-label="Toggle navigation">
	        <svg class="search" width="18" height="18">
          <use xlink:href="#search"></use>
        </svg>
      </li>
	      <li class="pe-3 account-menu">
	        <a href="{{ route('account') }}" class="d-flex align-items-center">
	          <svg class="user" width="18" height="18">
	            <use xlink:href="#user"></use>
	          </svg>
	          @auth
	            <span class="account-role-label ms-2">{{ auth()->user()->isAdmin() ? 'Admin' : 'User' }}</span>
	          @endauth
	        </a>
          @auth
            <div class="account-dropdown">
              <a href="{{ route('account') }}">My Account</a>
              <a href="{{ route('account.orders') }}">My Orders</a>
              <a href="{{ route('account.wishlist') }}">Wishlist</a>
              <a href="{{ route('account') }}#address-book">Addresses</a>
              <a href="{{ route('account') }}#password-settings">Change Password</a>
              @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
              @endif
            </div>
          @endauth
	      </li>
	      @auth
	      <li class="pe-3">
	        <form method="POST" action="{{ route('logout') }}" class="logout-form">
	          @csrf
	          <button type="submit" class="logout-btn d-flex align-items-center">Logout</button>
	        </form>
	      </li>
	      @endauth
	      <li>
	        <a href="/cart">
	          <svg class="cart" width="18" height="18">
	            <use xlink:href="#cart"></use>
	          </svg>
	        </a>
	      </li>
	    </ul>
	  </div>
</li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </header>

    <section id="billboard" class="overflow-hidden">
      <div class="swiper main-swiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <div
                    class="banner-item align-content-center"
                    style="
                      background-image: url(assets/images/banner-image1.jpg);
                      background-repeat: no-repeat;
                      background-position: right;
                      height: 850px;
                    "
                  >
                    <div class="banner-content padding-large px-5 px-lg-0">
                      <h2 class="display-2 text-capitalize text-dark pb-2">
                        Classic Cotton T-Shirt
                      </h2>
                      <p>
                        Experience ultimate comfort with our premium cotton
                        t-shirts. Perfect for everyday wear, they provide a
                        stylish and relaxed fit for any occasion.
                      </p>
                      <a
                        href="/shop"
                        class="btn btn-medium btn-arrow position-relative mt-3"
                      >
                        <span class="text-capitalize">Shop Now</span>
                        <svg
                          class="arrow-right position-absolute"
                          width="18"
                          height="20"
                        >
                          <use xlink:href="#arrow-right"></use></svg
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <div
                    class="banner-item align-content-center"
                    style="
                      background-image: url(assets/images/banner-image2.jpg);
                      background-repeat: no-repeat;
                      background-position: right;
                      height: 850px;
                    "
                  >
                    <div class="banner-content padding-large px-5 px-lg-0">
                      <h2 class="display-2 text-capitalize text-dark pb-2">
                        Trendy Graphic Hoodie
                      </h2>
                      <p>
                        Stay cozy and stylish with our latest collection of
                        graphic hoodies. Designed for comfort and warmth, they
                        are the perfect addition to your wardrobe.
                      </p>
                      <a
                        href="/shop"
                        class="btn btn-medium btn-arrow position-relative mt-3"
                      >
                        <span class="text-capitalize">Shop Now</span>
                        <svg
                          class="arrow-right position-absolute"
                          width="18"
                          height="20"
                        >
                          <use xlink:href="#arrow-right"></use></svg
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <div
                    class="banner-item align-content-center"
                    style="
                      background-image: url(assets/images/banner-image3.jpg);
                      background-repeat: no-repeat;
                      background-position: right;
                      height: 850px;
                    "
                  >
                    <div class="banner-content padding-large px-5 px-lg-0">
                      <h2 class="display-2 text-capitalize text-dark pb-2">
                        Minimalist Oversized Tee
                      </h2>
                      <p>
                        Elevate your streetwear game with our minimalist
                        oversized tees. Crafted for style and comfort, they pair
                        effortlessly with any outfit.
                      </p>
                      <a
                        href="/shop"
                        class="btn btn-medium btn-arrow position-relative mt-3"
                      >
                        <span class="text-capitalize">Shop Now</span>
                        <svg
                          class="arrow-right position-absolute"
                          width="18"
                          height="20"
                        >
                          <use xlink:href="#arrow-right"></use></svg
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="swiper-pagination position-absolute"></div>
    </section>

    <section id="banner" class="padding-large">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4 banner-content-1 position-relative">
            <div>
              <img
                src="{{ asset('assets/images/product-large-2.jpg') }}"
                class="img-fluid"
                alt="img"
              />
            </div>
            <div
              class="banner-content-text position-absolute bottom-0 start-0 text-center w-100 py-5 mb-5 bg-white bg-opacity-50"
            >
              <h2 class="display-5">Modern Collection</h2>
              <a
                href="/shop"
                class="btn btn-medium btn-arrow outline-dark position-relative mt-3"
              >
                <span class="text-capitalize fs-6">Shop Now</span>
                <svg
                  class="arrow-right position-absolute"
                  width="18"
                  height="20"
                >
                  <use xlink:href="#arrow-right"></use></svg
              ></a>
            </div>
          </div>
          <div class="col-md-4 banner-content-2 position-relative">
            <div>
              <img
                src="{{ asset('assets/images/product-large-3.jpg') }}"
                class="img-fluid"
                alt="img"
              />
            </div>
            <div
              class="banner-content-text position-absolute bottom-0 start-0 text-center w-100 py-5 mb-5 bg-white bg-opacity-50"
            >
              <h2 class="display-5">Classic Collection</h2>
              <a
                href="/shop"
                class="btn btn-medium btn-arrow outline-dark position-relative mt-3"
              >
                <span class="text-capitalize fs-6">Shop Now</span>
                <svg
                  class="arrow-right position-absolute"
                  width="18"
                  height="20"
                >
                  <use xlink:href="#arrow-right"></use></svg
              ></a>
            </div>
          </div>
          <div class="col-md-4 banner-content-3 position-relative">
            <div>
              <img
                src="{{ asset('assets/images/product-large-4.jpg') }}"
                class="img-fluid"
                alt="img"
              />
            </div>
            <div
              class="banner-content-text position-absolute bottom-0 start-0 text-center w-100 py-5 mb-5 bg-white bg-opacity-50"
            >
              <h2 class="display-5">New Collection</h2>
              <a
                href="/shop"
                class="btn btn-medium btn-arrow outline-dark position-relative mt-3"
              >
                <span class="text-capitalize fs-6">Shop Now</span>
                <svg
                  class="arrow-right position-absolute"
                  width="18"
                  height="20"
                >
                  <use xlink:href="#arrow-right"></use></svg
              ></a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="about-us" class="padding-large pt-0">
      <div class="container-fluid">
        <div class="row align-items-center justify-content-between">
          <div class="col-md-6 offset-md-3">
            <div class="detail">
              <div class="display-header text-center">
                <h2 class="display-2 text-capitalize text-dark pb-2">
                  About Us
                </h2>
                <p class="pb-3">
                  Ac varius lectus tellus tellus quisque tristique aenean.
                  Volutpat velit nulla eu iaculis risus in urna. Eu morbi vel
                  purus velit dui vel egestas purus sed. Eget turpis tincidunt
                  faucibus montes arcu in nullam tortor orci. Nulla tellus sed
                  purus vestibulum sagittis pretium donec nec mattis ollis porta
                  sit ut.
                </p>
                <a
                  href="/about-us"
                  class="btn btn-medium btn-arrow outline-dark position-relative mt-3"
                >
                  <span class="text-capitalize">About us</span>
                  <svg
                    class="arrow-right position-absolute"
                    width="18"
                    height="20"
                  >
                    <use xlink:href="#arrow-right"></use></svg
                ></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="featured-products" class="product-store position-relative">
      <div class="container-fluid">
        <div class="row">
          <div
            class="display-header pb-3 d-md-flex justify-content-between align-items-center flex-wrap col-md-12"
          >
            <h2 class="display-2 text-dark text-capitalize">
              Our Featured Products
            </h2>
            <a
              href="/shop"
              class="btn btn-medium btn-arrow outline-dark position-relative"
            >
              <span class="text-capitalize">Shop All</span>
              <svg class="arrow-right position-absolute" width="18" height="20">
                <use xlink:href="#arrow-right"></use></svg
            ></a>
          </div>
        </div>
        <div class="row">
          <div id="featured-swiper" class="product-swiper col-md-12">
            <div class="swiper">
              <div class="swiper-wrapper">
                @foreach ($featuredProducts as $product)
                  @include('user.partials.home-product-slide', ['product' => $product])
                @endforeach
              </div>
            </div>
            <div class="swiper-pagination text-center mt-5"></div>
          </div>
        </div>
      </div>
    </section>

    <section id="customer-testimonials" class="padding-large">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div
              class="display-header pb-3 d-md-flex justify-content-between align-items-end flex-wrap"
            >
              <div>
                <h2 class="display-2 text-dark text-capitalize">
                  Customer Reviews
                </h2>
                <p class="mb-0 text-black-50">
                  What our customers say about our products.
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="testimonials-grid">
          <article class="testimonial-card testimonial-card--featured">
            <div class="testimonial-head">
              <img
                class="testimonial-avatar"
                src="{{ asset('assets/images/commentor-item1.jpg') }}"
                alt="Customer Daniel Clifford"
                loading="lazy"
              />
              <div class="testimonial-meta">
                <div class="testimonial-name">Daniel Clifford</div>
                <div class="testimonial-subtitle">Verified Buyer</div>
              </div>
              <div class="testimonial-rating" aria-label="5 out of 5 stars">
                ★★★★★
              </div>
            </div>
            <div class="testimonial-quote" aria-hidden="true">
              <svg class="quote" width="44" height="44">
                <use xlink:href="#quote" />
              </svg>
            </div>
            <p class="testimonial-title">
              “Premium quality and perfect fit.”
            </p>
            <p class="testimonial-text">
              I received my order in a few days and the fabric feels premium.
              The hoodie is warm, the stitching is clean, and the fit is exactly
              what I wanted. Worth every penny.
            </p>
          </article>

          <article class="testimonial-card testimonial-card--dark">
            <div class="testimonial-head">
              <img
                class="testimonial-avatar"
                src="{{ asset('assets/images/commentor-item2.jpg') }}"
                alt="Customer Jonathan Walters"
                loading="lazy"
              />
              <div class="testimonial-meta">
                <div class="testimonial-name">Jonathan Walters</div>
                <div class="testimonial-subtitle">Verified Buyer</div>
              </div>
              <div class="testimonial-rating" aria-label="4 out of 5 stars">
                ★★★★☆
              </div>
            </div>
            <p class="testimonial-title">“Comfortable and stylish.”</p>
            <p class="testimonial-text">
              The tees are super soft and breathable. Colors look great even
              after washing. I’ll definitely come back for more.
            </p>
          </article>

          <article class="testimonial-card">
            <div class="testimonial-head">
              <img
                class="testimonial-avatar"
                src="{{ asset('assets/images/commentor-item3.jpg') }}"
                alt="Customer Kira Whittle"
                loading="lazy"
              />
              <div class="testimonial-meta">
                <div class="testimonial-name">Kira Whittle</div>
                <div class="testimonial-subtitle">Verified Buyer</div>
              </div>
              <div class="testimonial-rating" aria-label="5 out of 5 stars">
                ★★★★★
              </div>
            </div>
            <p class="testimonial-title">“Highly recommended.”</p>
            <p class="testimonial-text">
              Great customer support and the product quality exceeded my
              expectations. The oversized tee has an amazing drape.
            </p>
          </article>

          <article class="testimonial-card">
            <div class="testimonial-head">
              <img
                class="testimonial-avatar"
                src="{{ asset('assets/images/author-item.jpg') }}"
                alt="Customer Jeanette Harmon"
                loading="lazy"
              />
              <div class="testimonial-meta">
                <div class="testimonial-name">Jeanette Harmon</div>
                <div class="testimonial-subtitle">Verified Buyer</div>
              </div>
              <div class="testimonial-rating" aria-label="5 out of 5 stars">
                ★★★★★
              </div>
            </div>
            <p class="testimonial-title">“An overall wonderful experience.”</p>
            <p class="testimonial-text">
              Packaging was neat and delivery was fast. The hoodie is cozy and
              fits perfectly around the shoulders.
            </p>
          </article>

          <article class="testimonial-card testimonial-card--accent">
            <div class="testimonial-head">
              <img
                class="testimonial-avatar"
                src="{{ asset('assets/images/review-image1.jpg') }}"
                alt="Customer Patrick Abrams"
                loading="lazy"
              />
              <div class="testimonial-meta">
                <div class="testimonial-name">Patrick Abrams</div>
                <div class="testimonial-subtitle">Verified Buyer</div>
              </div>
              <div class="testimonial-rating" aria-label="4 out of 5 stars">
                ★★★★☆
              </div>
            </div>
            <p class="testimonial-title">“Great value for money.”</p>
            <p class="testimonial-text">
              The print quality is sharp and the fabric holds up well. This is
              the kind of everyday wear I was looking for.
            </p>
          </article>
        </div>
      </div>
    </section>

    <section id="trending-products" class="product-store">
      <div class="container-fluid">
        <div class="row overflow-hidden">
          <div
            class="display-header pb-3 d-md-flex justify-content-between align-items-center col-md-12"
          >
            <h2 class="display-2 text-dark text-capitalize">
              Trending products
            </h2>
            <a
              href="/shop"
              class="btn btn-medium btn-arrow outline-dark position-relative"
            >
              <span class="text-capitalize">Shop all</span>
              <svg class="arrow-right position-absolute" width="18" height="20">
                <use xlink:href="#arrow-right"></use></svg
            ></a>
          </div>
          <div id="trending-swiper" class="product-swiper col-md-12">
            <div class="swiper">
              <div class="swiper-wrapper">
                @foreach ($trendingProducts as $product)
                  @include('user.partials.home-product-slide', ['product' => $product])
                @endforeach
              </div>
              <div class="swiper-pagination text-center mt-5"></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="latest-blog" class="padding-large">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div
              class="display-header d-md-flex flex-wrap justify-content-between align-items-center pb-3"
            >
              <h2 class="display-2 text-dark text-capitalize">
                Read Our Articles
              </h2>
              <a
                href="/blog"
                class="btn btn-medium btn-arrow outline-dark position-relative"
              >
                <span class="text-capitalize">See all articles</span>
                <svg
                  class="arrow-right position-absolute"
                  width="18"
                  height="20"
                >
                  <use xlink:href="#arrow-right"></use></svg
              ></a>
            </div>
          </div>
        </div>
        <div class="row post-grid">
          <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
            <div class="card-item">
              <div class="card border-0 bg-transparent">
                <div class="card-image image-zoom-effect">
                  <a href="/single-post">
                    <img
                      src="{{ asset('assets/images/post-item8.jpg') }}"
                      alt="image"
                      class="post-image img-fluid"
                  /></a>
                </div>
              </div>
              <div class="card-body p-0 mt-4">
                <h3 class="card-title text-capitalize">
                  <a href="/single-post"
                    >Best T-shirts and Hoodies for Every Season</a
                  >
                </h3>
                <p>
                  Discover the perfect t-shirts and hoodies that combine comfort
                  and style for every occasion. Stay trendy with our latest
                  collection.
                  <span
                    ><a
                      href="/single-post"
                      class="text-decoration-underline text-black-50 text-capitalize p-0"
                      ><em>Read More</em></a
                    ></span
                  >
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
            <div class="card-item">
              <div class="card border-0">
                <div class="card-image image-zoom-effect">
                  <a href="/single-post">
                    <img
                      src="{{ asset('assets/images/post-item2.jpg') }}"
                      alt="image"
                      class="post-image img-fluid"
                  /></a>
                </div>
              </div>
              <div class="card-body p-0 mt-4">
                <h3 class="card-title text-capitalize">
                  <a href="/single-post"
                    >Top T-shirt and Hoodie Trends for 2024</a
                  >
                </h3>
                <p>
                  Stay ahead in fashion with the latest t-shirt and hoodie
                  trends. From minimal designs to bold graphics, find your
                  perfect match.
                  <span
                    ><a
                      href="/single-post"
                      class="text-decoration-underline text-black-50 text-capitalize p-0"
                      ><em>Read More</em></a
                    ></span
                  >
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
            <div class="card-item">
              <div class="card border-0">
                <div class="card-image image-zoom-effect">
                  <a href="/single-post">
                    <img
                      src="{{ asset('assets/images/post-item3.jpg') }}"
                      alt="image"
                      class="post-image img-fluid"
                  /></a>
                </div>
              </div>
              <div class="card-body p-0 mt-4">
                <h3 class="card-title text-capitalize">
                  <a href="/single-post"
                    >Why Minimalist T-shirt Designs Are Timeless</a
                  >
                </h3>
                <p>
                  Minimalist t-shirt designs never go out of style. Explore how
                  simple yet elegant designs can elevate your everyday look.
                  <span
                    ><a
                      href="/single-post"
                      class="text-decoration-underline text-black-50 text-capitalize p-0"
                      ><em>Read More</em></a
                    ></span
                  >
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="company-services" class="py-5 border-top border-bottom">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-md-6 pb-3">
            <div class="icon-box d-flex align-items-center">
              <div class="icon-box-icon pt-3 pe-3 pb-3 ps-3">
                <svg class="shipping-fast">
                  <use xlink:href="#shipping-fast" />
                </svg>
              </div>
              <div class="icon-box-content ps-3">
                <h3 class="card-title text-capitalize text-dark mb-0">
                  Quick delivery
                </h3>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 pb-3">
            <div class="icon-box d-flex align-items-center">
              <div class="icon-box-icon pt-3 pe-3 pb-3 ps-3">
                <svg class="shopping-cart">
                  <use xlink:href="#shopping-cart" />
                </svg>
              </div>
              <div class="icon-box-content ps-3">
                <h3 class="card-title text-capitalize text-dark mb-0">
                  Pick up in store
                </h3>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 pb-3">
            <div class="icon-box d-flex align-items-center">
              <div class="icon-box-icon pt-3 pe-3 pb-3 ps-3">
                <svg class="gift">
                  <use xlink:href="#gift" />
                </svg>
              </div>
              <div class="icon-box-content ps-3">
                <h3 class="card-title text-capitalize text-dark mb-0">
                  Special Packaging
                </h3>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 pb-3">
            <div class="icon-box d-flex align-items-center">
              <div class="icon-box-icon pt-3 pe-3 pb-3 ps-3">
                <svg class="return">
                  <use xlink:href="#return" />
                </svg>
              </div>
              <div class="icon-box-content ps-3">
                <h3 class="card-title text-capitalize text-dark mb-0">
                  Return & refund policy
                </h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="subscribe padding-large">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-6">
            <div class="subscribe-content text-center">
              <div class="subscribe-header">
                <h2 class="display-4">
                  Get offers & discounts by subscribing us
                </h2>
              </div>
              <form id="form" class="mt-4">
                <input
                  type="text"
                  name="email"
                  placeholder="Enter Your Email Addresss"
                  class="w-100 bg-light border ps-5 fst-italic rounded-2"
                />
                <button class="btn btn-full btn-black text-capitalize">
                  Subscribe Now
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer id="footer" class="overflow-hidden">
      <div class="container-fluid">
        <div class="row">
          <div class="row d-flex flex-wrap justify-content-between">
            <div class="col-lg-3 col-sm-6 pb-3 pe-4">
              <div class="footer-menu">
                <img
                  src="{{ asset('assets/images/main-logo.png') }}"
                  alt="logo"
                  class="pb-3"
                />
                <p>
                  Mi facilisis facilisis orci vitae. Cum nisi morbi integer
                  tincidunt ornare ac praesent in. Dolor tempus arcu sit quis
                  nunc arcu facilisis quis eget nisi morbi integer.
                </p>
              </div>
            </div>
            <div class="col-lg-2 col-sm-6 pb-3">
              <div class="footer-menu text-capitalize">
                <h5 class="widget-title pb-2">Quick Links</h5>
                <ul class="menu-list list-unstyled text-capitalize">
                  <li class="menu-item pb-2">
                    <a href="#billboard">Home</a>
                  </li>
                  <li class="menu-item pb-2">
                    <a href="#about-us">About</a>
                  </li>
                  <li class="menu-item pb-2">
                    <a href="#company-services">Services</a>
                  </li>
                  <li class="menu-item pb-2">
                    <a href="#latest-blog">Blogs</a>
                  </li>
                  <li class="menu-item pb-2">
                    <a href="#contact">Contact</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-2 col-sm-6 pb-3">
              <div class="footer-menu text-capitalize">
                <h5 class="widget-title pb-2">Social</h5>
                <div class="social-links">
                  <ul class="list-unstyled">
                    <li class="pb-2">
                      <a href="#">Facebook</a>
                    </li>
                    <li class="pb-2">
                      <a href="#">Twitter</a>
                    </li>
                    <li class="pb-2">
                      <a href="#">Pinterest</a>
                    </li>
                    <li class="pb-2">
                      <a href="#">Instagram</a>
                    </li>
                    <li>
                      <a href="#">Youtube</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6">
              <div class="footer-menu contact-item">
                <h5 class="widget-title text-capitalize pb-2">Contact Us</h5>
                <p><a href="#">+ 12(0) 34 56 78 910</a></p>
                <p><a href="mailto:">info&#64;yourmail.com</a></p>
                <p>tea berry, marinette, USA</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-gray border-top">
        <div class="text-center py-4">
          <p class="mb-0">©2025 Rural.</p>
        </div>
      </div>
    </footer>
@endsection
