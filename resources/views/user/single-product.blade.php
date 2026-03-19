@extends('layouts.user')

@section('body_attributes') class="bg-body" data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%"
  data-bs-smooth-scroll="true" tabindex="0"@endsection

@section('content')
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol xmlns="http://www.w3.org/2000/svg" id="expert" viewBox="0 0 15 15">
      <path fill="currentColor" fill-rule="evenodd"
        d="M7.5.875a3.625 3.625 0 0 0-1.006 7.109c-1.194.145-2.218.567-2.99 1.328c-.982.967-1.479 2.408-1.479 4.288a.475.475 0 1 0 .95 0c0-1.72.453-2.88 1.196-3.612c.744-.733 1.856-1.113 3.329-1.113s2.585.38 3.33 1.113c.742.733 1.195 1.892 1.195 3.612a.475.475 0 1 0 .95 0c0-1.88-.497-3.32-1.48-4.288c-.77-.76-1.795-1.183-2.989-1.328A3.627 3.627 0 0 0 7.5.875ZM4.825 4.5a2.675 2.675 0 1 1 5.35 0a2.675 2.675 0 0 1-5.35 0Z"
        clip-rule="evenodd" />
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="creative" viewBox="0 0 24 24">
      <path fill="currentColor"
        d="m18.85 10.39l1.06-1.06c.78-.78.78-2.05 0-2.83L18.5 5.09c-.78-.78-2.05-.78-2.83 0l-1.06 1.06l4.24 4.24zm-4.24 1.42L7.41 19H6v-1.41l7.19-7.19l1.42 1.41zm-1.42-4.25L4 16.76V21h4.24l9.19-9.19l-4.24-4.25zM19 17.5c0 2.19-2.54 3.5-5 3.5c-.55 0-1-.45-1-1s.45-1 1-1c1.54 0 3-.73 3-1.5c0-.47-.48-.87-1.23-1.2l1.48-1.48c1.07.63 1.75 1.47 1.75 2.68zM4.58 13.35C3.61 12.79 3 12.06 3 11c0-1.8 1.89-2.63 3.56-3.36C7.59 7.18 9 6.56 9 6c0-.41-.78-1-2-1c-1.26 0-1.8.61-1.83.64c-.35.41-.98.46-1.4.12a.992.992 0 0 1-.15-1.38C3.73 4.24 4.76 3 7 3s4 1.32 4 3c0 1.87-1.93 2.72-3.64 3.47C6.42 9.88 5 10.5 5 11c0 .31.43.6 1.07.86l-1.49 1.49z" />
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="dedicated" viewBox="0 0 24 24">
      <g id="feTarget0" fill="none" fill-rule="evenodd" stroke="none" stroke-width="1">
        <g id="feTarget1" fill="currentColor" fill-rule="nonzero">
          <path id="feTarget2"
            d="M19.938 13A8.004 8.004 0 0 1 13 19.938V22h-2v-2.062A8.004 8.004 0 0 1 4.062 13H2v-2h2.062A8.004 8.004 0 0 1 11 4.062V2h2v2.062A8.004 8.004 0 0 1 19.938 11H22v2h-2.062ZM12 18a6 6 0 1 0 0-12a6 6 0 0 0 0 12Zm0-3a3 3 0 1 0 0-6a3 3 0 0 0 0 6Z" />
        </g>
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="shopping-cart" viewBox="0 0 512 496">
      <path fill="currentColor"
        d="M448 69H137l-3-12q-5-23-22.5-37.5T70 5H21q-9 0-15 6T0 27q0 9 6 15t15 6h49q19 0 22 17l49 256q6 21 23.5 34t38.5 13h202q10 0 16-6t6-15q0-22-22-22H203q-14 0-20-12l-2-9h214q20 0 36.5-12t22.5-31l58-123v-5q0-27-18.5-45.5T448 69zm-32 175v2q-3 15-21 15H173l-28-149h303q18 0 21 17zM256 432q0 18-12.5 30.5T213 475q-17 0-29.5-12.5T171 432t12.5-30.5T213 389q18 0 30.5 12.5T256 432zm171 0q0 18-12.5 30.5T384 475t-30.5-12.5T341 432t12.5-30.5T384 389t30.5 12.5T427 432z" />
    </symbol>
    <symbol id="search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
      <title>Search</title>
      <path fill="currentColor"
        d="M19 3C13.488 3 9 7.488 9 13c0 2.395.84 4.59 2.25 6.313L3.281 27.28l1.439 1.44l7.968-7.969A9.922 9.922 0 0 0 19 23c5.512 0 10-4.488 10-10S24.512 3 19 3zm0 2c4.43 0 8 3.57 8 8s-3.57 8-8 8s-8-3.57-8-8s3.57-8 8-8z" />
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="user" viewBox="0 0 16 16">
      <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="cart" viewBox="0 0 16 16">
      <path
        d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="arrow-left" viewBox="0 0 32 32">
      <path fill="currentColor"
        d="m13.281 6.781l-8.5 8.5l-.687.719l.687.719l8.5 8.5l1.438-1.438L7.938 17H28v-2H7.937l6.782-6.781z" />
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="arrow-right" viewBox="0 0 32 32">
      <path fill="currentColor"
        d="M18.719 6.781L17.28 8.22L24.063 15H4v2h20.063l-6.782 6.781l1.438 1.438l8.5-8.5l.687-.719l-.687-.719z" />
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="shipping-fast" viewBox="0 0 32 32">
      <path fill="currentColor"
        d="M0 6v2h19v15h-6.156c-.446-1.719-1.992-3-3.844-3c-1.852 0-3.398 1.281-3.844 3H4v-5H2v7h3.156c.446 1.719 1.992 3 3.844 3c1.852 0 3.398-1.281 3.844-3h8.312c.446 1.719 1.992 3 3.844 3c1.852 0 3.398-1.281 3.844-3H32v-8.156l-.063-.157l-2-6L29.72 10H21V6zm1 4v2h9v-2zm20 2h7.281L30 17.125V23h-1.156c-.446-1.719-1.992-3-3.844-3c-1.852 0-3.398 1.281-3.844 3H21zM2 14v2h6v-2zm7 8c1.117 0 2 .883 2 2s-.883 2-2 2s-2-.883-2-2s.883-2 2-2zm16 0c1.117 0 2 .883 2 2s-.883 2-2 2s-2-.883-2-2s.883-2 2-2z" />
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="shopping-cart" viewBox="0 0 32 32">
      <path fill="currentColor"
        d="M5 7c-.55 0-1 .45-1 1s.45 1 1 1h2.219l2.625 10.5c.222.89 1.02 1.5 1.937 1.5H23.25c.902 0 1.668-.598 1.906-1.469L27.75 10H11l.5 2h13.656l-1.906 7H11.781L9.156 8.5A1.983 1.983 0 0 0 7.22 7zm17 14c-1.645 0-3 1.355-3 3s1.355 3 3 3s3-1.355 3-3s-1.355-3-3-3zm-9 0c-1.645 0-3 1.355-3 3s1.355 3 3 3s3-1.355 3-3s-1.355-3-3-3zm0 2c.563 0 1 .438 1 1c0 .563-.438 1-1 1c-.563 0-1-.438-1-1c0-.563.438-1 1-1zm9 0c.563 0 1 .438 1 1c0 .563-.438 1-1 1c-.563 0-1-.438-1-1c0-.563.438-1 1-1z" />
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="gift" viewBox="0 0 32 32">
      <path fill="currentColor"
        d="M12 5c-1.645 0-3 1.355-3 3c0 .352.074.684.188 1H4v6h1v13h22V15h1V9h-5.188A2.95 2.95 0 0 0 23 8c0-1.645-1.355-3-3-3c-1.75 0-2.938 1.328-3.719 2.438c-.105.148-.187.292-.281.437c-.094-.145-.176-.29-.281-.438C14.938 6.329 13.75 5 12 5zm0 2c.625 0 1.438.672 2.063 1.563c.152.218.128.23.25.437H12c-.566 0-1-.434-1-1c0-.566.434-1 1-1zm8 0c.566 0 1 .434 1 1c0 .566-.434 1-1 1h-2.313c.122-.207.098-.219.25-.438C18.563 7.673 19.375 7 20 7zM6 11h20v2h-9v-1h-2v1H6zm1 4h18v11h-8V16h-2v10H7z" />
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="return" viewBox="0 0 32 32">
      <path fill="currentColor"
        d="M16 3C8.832 3 3 8.832 3 16s5.832 13 13 13s13-5.832 13-13h-2c0 6.086-4.914 11-11 11S5 22.086 5 16S9.914 5 16 5c3.875 0 7.262 1.984 9.219 5H20v2h8V4h-2v3.719C23.617 4.844 20.02 3 16 3z" />
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="quote" viewBox="0 0 24 24">
      <path fill="currentColor" d="m15 17l2-4h-4V6h7v7l-2 4h-3Zm-9 0l2-4H4V6h7v7l-2 4H6Z" />
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="nav-icon" viewBox="0 0 16 16">
      <path
        d="M14 10.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 .5-.5zm0-3a.5.5 0 0 0-.5-.5h-7a.5.5 0 0 0 0 1h7a.5.5 0 0 0 .5-.5zm0-3a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0 0 1h11a.5.5 0 0 0 .5-.5z" />
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="close" viewBox="0 0 16 16">
      <path
        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="navbar-icon" viewBox="0 0 16 16">
      <path
        d="M14 10.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 .5-.5zm0-3a.5.5 0 0 0-.5-.5h-7a.5.5 0 0 0 0 1h7a.5.5 0 0 0 .5-.5zm0-3a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0 0 1h11a.5.5 0 0 0 .5-.5z" />
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="star-outline" viewBox="0 0 15 15">
      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
        d="M7.5 9.804L5.337 11l.413-2.533L4 6.674l2.418-.37L7.5 4l1.082 2.304l2.418.37l-1.75 1.793L9.663 11L7.5 9.804Z" />
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="star-solid" viewBox="0 0 15 15">
      <path fill="currentColor"
        d="M7.953 3.788a.5.5 0 0 0-.906 0L6.08 5.85l-2.154.33a.5.5 0 0 0-.283.843l1.574 1.613l-.373 2.284a.5.5 0 0 0 .736.518l1.92-1.063l1.921 1.063a.5.5 0 0 0 .736-.519l-.373-2.283l1.574-1.613a.5.5 0 0 0-.283-.844L8.921 5.85l-.968-2.062Z" />
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="plus" viewBox="0 0 24 24">
      <path fill="currentColor" d="M19 11h-6V5a1 1 0 0 0-2 0v6H5a1 1 0 0 0 0 2h6v6a1 1 0 0 0 2 0v-6h6a1 1 0 0 0 0-2Z" />
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="minus" viewBox="0 0 24 24">
      <path fill="currentColor" d="M19 11H5a1 1 0 0 0 0 2h14a1 1 0 0 0 0-2Z" />
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" id="heart" viewBox="0 0 24 24">
      <path fill="currentColor"
        d="M20.16 4.61A6.27 6.27 0 0 0 12 4a6.27 6.27 0 0 0-8.16 9.48l7.45 7.45a1 1 0 0 0 1.42 0l7.45-7.45a6.27 6.27 0 0 0 0-8.87Zm-1.41 7.46L12 18.81l-6.75-6.74a4.28 4.28 0 0 1 3-7.3a4.25 4.25 0 0 1 3 1.25a1 1 0 0 0 1.42 0a4.27 4.27 0 0 1 6 6.05Z" />
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
        <input type="text" class="search-input fs-5 p-4 bg-transparent" placeholder="Search...">
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
          <img src="{{ asset('assets/images/main-logo.png') }}" class="logo"></a>
        <button class="navbar-toggler d-flex d-lg-none order-3 p-0" type="button" data-bs-toggle="offcanvas"
          data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-expanded="false" aria-label="Toggle navigation">
          <svg class="navbar-icon" width="50" height="50">
            <use xlink:href="#navbar-icon"></use>
          </svg>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="bdNavbar" aria-labelledby="bdNavbarOffcanvasLabel">
          <div class="offcanvas-header px-4 pb-0">
            <a class="navbar-brand" href="/">
              <img src="{{ asset('assets/images/main-logo.png') }}" class="logo"></a>
            <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"
              data-bs-target="#bdNavbar"></button>
          </div>
          <div class="offcanvas-body">
            <ul id="navbar" class="navbar-nav text-capitalize justify-content-end align-items-center flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link me-4" href="/">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link me-4" href="/about-us">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link me-4" href="/shop">Shop</a>
              </li>
<li class="nav-item">
  <a class="nav-link me-4" href="/blog">Blog</a>
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

  <section class="hero-section d-flex align-items-center margin-large">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="hero-content col-md-6 text-center">
          <h1 class="display-1">Single-Product</h1>
          <div class="breadcrumbs">
            <span class="item">
              <a href="/">Home /</a>
            </span>
            <span class="item">{{ $product->name }}</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="product-detail" class="single-product py-5 no-padding-top">
    <div class="container">
      <div class="row g-5">
        <div class="col-md-7">
          <div class="row">
            <div class="col-md-3 d-none d-md-block">
              <div class="swiper product-thumbnail-slider">
                <div class="swiper-wrapper">
                  @for($i = 0; $i < 4; $i++)
                    <div class="swiper-slide">
                      <img src="{{ asset($product->image_path ?: 'assets/images/product-item1.jpg') }}" alt="{{ $product->name }}" class="thumb-image img-fluid">
                    </div>
                  @endfor
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <div class="swiper product-large-slider">
                <div class="swiper-wrapper">
                  @for($i = 0; $i < 4; $i++)
                    <div class="swiper-slide">
                      <img src="{{ asset($product->image_path ?: 'assets/images/product-item1.jpg') }}" alt="{{ $product->name }}" class="img-fluid">
                    </div>
                  @endfor
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="product-info">
            <div class="element-header">
              <h2 itemprop="name" class="product-title text-uppercase">{{ $product->name }}</h2>
              <div class="rating-container d-flex align-items-center">
                <div class="rating" data-rating="1" onclick=rate(1)>
                  <svg width="32" height="32">
                    <use xlink:href="#star-solid"></use>
                  </svg>
                </div>
                <div class="rating" data-rating="2" onclick=rate(1)>
                  <svg width="32" height="32">
                    <use xlink:href="#star-solid"></use>
                  </svg>
                </div>
                <div class="rating" data-rating="3" onclick=rate(1)>
                  <svg width="32" height="32">
                    <use xlink:href="#star-solid"></use>
                  </svg>
                </div>
                <div class="rating" data-rating="4" onclick=rate(1)>
                  <svg width="32" height="32">
                    <use xlink:href="#star-outline"></use>
                  </svg>
                </div>
                <div class="rating" data-rating="5" onclick=rate(1)>
                  <svg width="32" height="32">
                    <use xlink:href="#star-outline"></use>
                  </svg>
                </div>
              </div>
            </div>
            <div class="product-price mb-3">
              <span class="fs-2">${{ number_format((float) $product->price, 2) }}</span>
            </div>
            <p>{{ $product->description ?: 'Premium quality product crafted for comfort and everyday wear.' }}</p>
            <div class="product-action mt-4">
              <div class="item-title">{{ $product->stock }} in stock</div>
              <div class="product-quantity d-flex flex-wrap">
                <div class="input-group product-qty me-3 border" style="max-width: 150px;">
                  <span class="input-group-btn">
                    <button type="button" class="quantity-left-minus btn btn-number" data-type="minus" data-field="">
                      <svg width="16" height="16">
                        <use xlink:href="#minus"></use>
                      </svg>
                    </button>
                  </span>
                  <input type="text" id="quantity" name="quantity"
                    class="form-control input-number text-center bg-gray-1" value="1" min="1" max="100">
                  <span class="input-group-btn">
                    <button type="button" class="quantity-right-plus btn btn-number" data-type="plus" data-field="">
                      <svg width="16" height="16">
                        <use xlink:href="#plus"></use>
                      </svg>
                    </button>
                  </span>
                </div>
                <button type="button" name="add" id="add-to-cart-btn" class="btn btn-primary product-cart-submit me-3" data-product-id="{{ $product->id }}">
                  <span>Add to cart</span>
                </button>
                @auth
                  @if(($wishlistProductIds ?? collect())->contains($product->id))
                    <form method="POST" action="{{ route('account.wishlist.destroy-product', $product) }}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-light wish-list-button">
                        Remove Wishlist
                      </button>
                    </form>
                  @else
                    <form method="POST" action="{{ route('account.wishlist.store', $product) }}">
                      @csrf
                      <button type="submit" class="btn btn-light wish-list-button">
                        Add Wishlist
                      </button>
                    </form>
                  @endif
                @else
                  <a href="{{ route('account') }}" class="btn btn-light wish-list-button">
                    Wishlist
                  </a>
                @endauth
                <div class="detail-list mt-3">
                  <ul>
                    <li>
                      <strong>SKU:</strong>
                      <a href="#">{{ strtoupper($product->slug) }}</a>
                    </li>
                    <li>
                      <strong>Category:</strong>
                      <a href="{{ route('shop', ['category' => $product->category?->slug]) }}">{{ $product->category?->name ?? 'General' }}</a>
                    </li>
                    <li class="no-border-bottom">
                      <strong>Status:</strong>
                      <a href="#">{{ $product->is_featured ? 'Featured' : 'Standard' }}</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="product-tabs mt-5">
    <div class="container">
      <div class="row">
        <div class="tabs-listing">
          <nav>
            <div class="nav nav-tabs d-flex justify-content-center" id="nav-tab" role="tablist">
              <button class="nav-link active text-uppercase px-5 py-3 text-primary" id="nav-home-tab"
                data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                aria-selected="true">Description</button>
              <button class="nav-link text-uppercase px-5 py-3 text-primary" id="nav-information-tab"
                data-bs-toggle="tab" data-bs-target="#nav-information" type="button" role="tab"
                aria-controls="nav-information" aria-selected="false">Additional information</button>
              <button class="nav-link text-uppercase px-5 py-3 text-primary" id="nav-shipping-tab" data-bs-toggle="tab"
                data-bs-target="#nav-shipping" type="button" role="tab" aria-controls="nav-shipping"
                aria-selected="false">Shipping & Return</button>
              <button class="nav-link text-uppercase px-5 py-3 text-primary" id="nav-review-tab" data-bs-toggle="tab"
                data-bs-target="#nav-review" type="button" role="tab" aria-controls="nav-review"
                aria-selected="false">Reviews</button>
            </div>
          </nav>
          <div class="tab-content py-5" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
              <h5>Product Description</h5>
              <p>{{ $product->description ?: 'No product description available yet.' }}</p>
            </div>
            <div class="tab-pane fade" id="nav-information" role="tabpanel" aria-labelledby="nav-information-tab">
              <h5>Product Information</h5>
              <p>Category: {{ $product->category?->name ?? 'General' }}</p>
              <p>Stock available: {{ $product->stock }}</p>
              <p>Slug: {{ $product->slug }}</p>
            </div>
            <div class="tab-pane fade" id="nav-shipping" role="tabpanel" aria-labelledby="nav-shipping-tab">
              <h5>Returns Policy</h5>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eros justo, accumsan non dui sit amet.
                Phasellus semper volutpat mi sed imperdiet. Ut odio lectus, vulputate non ex non, mattis sollicitudin
                purus. Mauris consequat justo a enim interdum, in consequat dolor accumsan. Nulla iaculis diam purus,
                ut vehicula leo efficitur at.</p>
              <p>Interdum et malesuada fames ac ante ipsum primis in faucibus. In blandit nunc enim, sit amet pharetra
                erat aliquet ac.</p>
              <h5>Shipping</h5>
              <p>Pellentesque ultrices ut sem sit amet lacinia. Sed nisi dui, ultrices ut turpis pulvinar. Sed
                fringilla ex eget lorem consectetur, consectetur blandit lacus varius. Duis vel scelerisque elit, et
                vestibulum metus. Integer sit amet tincidunt tortor. Ut lacinia ullamcorper massa, a fermentum arcu
                vehicula ut. Ut efficitur faucibus dui Nullam tristique dolor eget turpis consequat varius. Quisque a
                interdum augue. Nam ut nibh mauris.</p>
            </div>
            <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
              <div class="review-box review-style1 d-flex">
                <div class="review-item d-flex">
                  <div class="row g-4">
                    <div class="col-md-3">
                      <div class="image-holder">
                        <img src="{{ asset('assets/images/review-image1.jpg') }}" alt="review" class="rounded-circle img-fluid">
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="review-content">
                        <div class="rating-container d-flex align-items-center">
                          <div class="rating" data-rating="1" onclick="rate(1)">
                            <svg width="32" height="32">
                              <use xlink:href="#star-solid"></use>
                            </svg>
                          </div>
                          <div class="rating" data-rating="2" onclick="rate(1)">
                            <svg width="32" height="32">
                              <use xlink:href="#star-solid"></use>
                            </svg>
                          </div>
                          <div class="rating" data-rating="3" onclick="rate(1)">
                            <svg width="32" height="32">
                              <use xlink:href="#star-solid"></use>
                            </svg>
                          </div>
                          <div class="rating" data-rating="4" onclick="rate(1)">
                            <svg width="32" height="32">
                              <use xlink:href="#star-outline"></use>
                            </svg>
                          </div>
                          <div class="rating" data-rating="5" onclick="rate(1)">
                            <svg width="32" height="32">
                              <use xlink:href="#star-outline"></use>
                            </svg>
                          </div>
                        </div>
                        <div class="review-header">
                          <span class="author-name">Serena Wilson</span>
                          <span class="review-date">– 07/05/2024</span>
                        </div>
                        <p>Vitae tortor condimentum lacinia quis vel eros donec ac. Nam at lectus urna duis convallis
                          convallis</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="review-item d-flex">
                  <div class="row g-4">
                    <div class="col-md-3">
                      <div class="image-holder">
                        <img src="{{ asset('assets/images/review-image2.jpg') }}" alt="review" class="rounded-circle img-fluid">
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="review-content">
                        <div class="rating-container d-flex align-items-center">
                          <div class="rating" data-rating="1" onclick="rate(1)">
                            <svg width="32" height="32">
                              <use xlink:href="#star-solid"></use>
                            </svg>
                          </div>
                          <div class="rating" data-rating="2" onclick="rate(1)">
                            <svg width="32" height="32">
                              <use xlink:href="#star-solid"></use>
                            </svg>
                          </div>
                          <div class="rating" data-rating="3" onclick="rate(1)">
                            <svg width="32" height="32">
                              <use xlink:href="#star-solid"></use>
                            </svg>
                          </div>
                          <div class="rating" data-rating="4" onclick="rate(1)">
                            <svg width="32" height="32">
                              <use xlink:href="#star-outline"></use>
                            </svg>
                          </div>
                          <div class="rating" data-rating="5" onclick="rate(1)">
                            <svg width="32" height="32">
                              <use xlink:href="#star-outline"></use>
                            </svg>
                          </div>
                        </div>
                        <div class="review-header">
                          <span class="author-name">Jenny Willis</span>
                          <span class="review-date">– 07/05/2024</span>
                        </div>
                        <p>Vitae tortor condimentum lacinia quis vel eros donec ac. Nam at lectus urna duis convallis
                          convallis</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="subscribe padding-large ">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-6">
          <div class="subscribe-content text-center">
            <div class="subscribe-header">
              <h2 class="display-4">Get offers & discounts by subscribing us</h2>
            </div>
            <form id="form" class="mt-4">
              <input type="text" name="email" placeholder="Enter Your Email Addresss"
                class="w-100 bg-light border ps-5 fst-italic rounded-2">
              <button class="btn btn-full btn-black text-capitalize">Subscribe Now</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer id="footer" class="overflow-hidden ">
    <div class="container-fluid">
      <div class="row">
        <div class="row d-flex flex-wrap justify-content-between">
          <div class="col-lg-3 col-sm-6 pb-3 pe-4">
            <div class="footer-menu">
              <img src="{{ asset('assets/images/main-logo.png') }}" alt="logo" class="pb-3">
              <p>Mi facilisis facilisis orci vitae. Cum nisi morbi integer tincidunt ornare ac praesent in. Dolor tempus
                arcu sit quis nunc arcu facilisis quis eget nisi morbi integer.</p>
            </div></div>
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
