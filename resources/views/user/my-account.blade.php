@extends('layouts.storefront')

@section('body_attributes') class="bg-body" data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%"
  data-bs-smooth-scroll="true" tabindex="0"@endsection

@section('page_title', 'My Account')

@section('storefront_content')
<section id="login-form" class="account-page py-5">
    <div class="container-sm">
      @if ($errors->any())
        <div class="row justify-content-center mb-4">
          <div class="col-lg-10">
            <div class="alert alert-danger mb-0">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      @endif

      @if (session('status'))
        <div class="row justify-content-center mb-4">
          <div class="col-lg-10">
            <div class="alert alert-success mb-0">{{ session('status') }}</div>
          </div>
        </div>
      @endif

      @auth
        @if (!$hasWishlistTable || !$hasAddressTable)
          <div class="row justify-content-center mb-4">
            <div class="col-lg-10">
              <div class="alert alert-warning mb-0">
                New account tables are not migrated yet. Wishlist and address book will appear after running the latest migrations.
              </div>
            </div>
          </div>
        @endif
      @endauth

      @auth
        <div class="row g-4">
          <div class="col-lg-4">
            <aside class="account-shell account-sidebar h-100">
              <div class="account-profile-card">
                <span class="account-eyebrow">Account Dashboard</span>
                @if(auth()->user()->profile_photo_path)
                  <img src="{{ asset(auth()->user()->profile_photo_path) }}" alt="{{ auth()->user()->name }}" class="account-avatar mb-3">
                @endif
                <h2 class="account-sidebar-title">{{ auth()->user()->name }}</h2>
                <p class="account-sidebar-copy mb-2">{{ auth()->user()->email }}</p>
                <span class="account-role-pill">{{ ucfirst(auth()->user()->role) }}</span>
              </div>

              <div class="account-quick-nav">
                <a href="#profile-settings">Profile Details</a>
                <a href="{{ route('account.orders') }}">My Orders</a>
                <a href="{{ route('account.wishlist') }}">Wishlist</a>
                <a href="#address-book">Address Book</a>
                <a href="#password-settings">Change Password</a>
              </div>

              <div class="account-sidebar-actions">
                <a href="{{ route('account.orders') }}" class="btn btn-outline-dark text-uppercase">My Orders</a>
                <a href="{{ route('account.wishlist') }}" class="btn btn-outline-dark text-uppercase">Wishlist</a>
                @if (auth()->user()->isAdmin())
                  <a href="{{ route('admin.dashboard') }}" class="btn btn-dark text-uppercase">Admin Dashboard</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="btn btn-dark w-100 text-uppercase">Logout</button>
                </form>
              </div>
            </aside>
          </div>

          <div class="col-lg-8">
            <div class="account-shell account-welcome-panel mb-4">
              <div class="row align-items-center g-4">
                <div class="col-lg-7">
                  <span class="account-eyebrow">Welcome Back</span>
                  <h2 class="account-section-title mb-3">Manage your orders, profile, addresses, and security from one place.</h2>
                  <p class="account-muted mb-0">Keep your details current, track recent purchases, and maintain a clean checkout experience from your personal dashboard.</p>
                </div>
                <div class="col-lg-5">
                  <div class="account-stat-grid">
                    <div class="account-stat-card">
                      <span>Orders</span>
                      <strong>{{ $ordersCount }}</strong>
                    </div>
                    <div class="account-stat-card">
                      <span>Wishlist</span>
                      <strong>{{ $wishlistCount }}</strong>
                    </div>
                    <div class="account-stat-card">
                      <span>Addresses</span>
                      <strong>{{ $addresses->count() }}</strong>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="account-shell mb-4">
              <div class="account-section-head">
                <div>
                  <span class="account-eyebrow">Orders</span>
                  <h2 class="account-section-title mb-0">Recent Orders</h2>
                </div>
                <a href="{{ route('account.orders') }}" class="btn btn-outline-dark btn-sm text-uppercase">View All</a>
              </div>

              @forelse($recentOrders as $order)
                <div class="account-order-row">
                  <div class="account-order-main">
                    <strong>{{ $order->order_number }}</strong>
                    <div class="text-muted small">{{ $order->created_at->format('M d, Y') }}</div>
                  </div>
                  <div class="account-order-status text-capitalize">{{ $order->status }}</div>
                  <div class="account-order-total">${{ number_format((float) $order->total, 2) }}</div>
                </div>
              @empty
                <p class="account-empty-state mb-0">No recent orders yet.</p>
              @endforelse
            </div>

            <div class="account-shell mb-4" id="profile-settings">
              <div class="account-section-head">
                <div>
                  <span class="account-eyebrow">Profile</span>
                  <h2 class="account-section-title mb-0">Profile Details</h2>
                </div>
              </div>
              <form method="POST" action="{{ route('account.profile.update') }}" class="row g-3" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-md-6">
                  <label class="account-label">Full Name *</label>
                  <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="account-label">Email Address *</label>
                  <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="account-label">Phone</label>
                  <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" class="form-control">
                </div>
                <div class="col-md-3">
                  <label class="account-label">Default Payment</label>
                  <select name="default_payment_method" class="form-control">
                    <option value="">Select</option>
                    @foreach(['cod' => 'Cash on delivery', 'bank_transfer' => 'Bank transfer', 'stripe' => 'Stripe'] as $value => $label)
                      <option value="{{ $value }}" @selected(old('default_payment_method', auth()->user()->default_payment_method) === $value)>{{ $label }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3">
                  <label class="account-label">Preferred Shipping</label>
                  <select name="preferred_shipping_method" class="form-control">
                    <option value="">Select</option>
                    <option value="standard" @selected(old('preferred_shipping_method', auth()->user()->preferred_shipping_method) === 'standard')>Standard</option>
                    <option value="express" @selected(old('preferred_shipping_method', auth()->user()->preferred_shipping_method) === 'express')>Express</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="account-label">Profile Photo</label>
                  <input type="file" name="profile_photo" class="form-control" accept="image/*">
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-dark text-uppercase">Save Profile</button>
                </div>
              </form>
            </div>

            <div class="account-shell mb-4" id="address-book">
              <div class="account-section-head">
                <div>
                  <span class="account-eyebrow">Delivery</span>
                  <h2 class="account-section-title mb-0">Address Book</h2>
                </div>
                <span class="account-muted">{{ $addresses->count() }} saved</span>
              </div>

              <div class="row g-3 mb-4">
                @forelse ($addresses as $address)
                  <div class="col-md-6">
                    <div class="account-address-card h-100">
                      <div class="d-flex justify-content-between align-items-start mb-3">
                        <strong>{{ $address->label }}</strong>
                        @if ($address->is_default)
                          <span class="account-default-badge">Default</span>
                        @endif
                      </div>
                      <p class="mb-1">{{ $address->recipient_name }}</p>
                      <p class="mb-1">{{ $address->line_1 }}@if($address->line_2), {{ $address->line_2 }}@endif</p>
                      <p class="mb-1">{{ $address->city }}, {{ $address->state }} {{ $address->postal_code }}</p>
                      <p class="account-muted mb-3">{{ $address->country }}@if($address->phone) • {{ $address->phone }}@endif</p>
                      <form method="POST" action="{{ route('account.addresses.destroy', $address) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-dark btn-sm text-uppercase">Remove</button>
                      </form>
                    </div>
                  </div>
                @empty
                  <div class="col-12">
                    <p class="text-muted mb-0">No saved addresses yet.</p>
                  </div>
                @endforelse
              </div>

              <form method="POST" action="{{ route('account.addresses.store') }}" class="row g-3">
                @csrf
                <div class="col-md-4">
                  <label class="account-label">Label *</label>
                  <input type="text" name="label" value="{{ old('label') }}" class="form-control" placeholder="Home, Office" required>
                </div>
                <div class="col-md-4">
                  <label class="account-label">Recipient Name *</label>
                  <input type="text" name="recipient_name" value="{{ old('recipient_name', auth()->user()->name) }}" class="form-control" required>
                </div>
                <div class="col-md-4">
                  <label class="account-label">Phone</label>
                  <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="account-label">Address Line 1 *</label>
                  <input type="text" name="line_1" value="{{ old('line_1') }}" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="account-label">Address Line 2</label>
                  <input type="text" name="line_2" value="{{ old('line_2') }}" class="form-control">
                </div>
                <div class="col-md-3">
                  <label class="account-label">City *</label>
                  <input type="text" name="city" value="{{ old('city') }}" class="form-control" required>
                </div>
                <div class="col-md-3">
                  <label class="account-label">State</label>
                  <input type="text" name="state" value="{{ old('state') }}" class="form-control">
                </div>
                <div class="col-md-3">
                  <label class="account-label">Postal Code</label>
                  <input type="text" name="postal_code" value="{{ old('postal_code') }}" class="form-control">
                </div>
                <div class="col-md-3">
                  <label class="account-label">Country *</label>
                  <input type="text" name="country" value="{{ old('country', 'USA') }}" class="form-control" required>
                </div>
                <div class="col-12">
                  <label class="d-inline-flex align-items-center gap-2 account-checkbox">
                    <input type="checkbox" name="is_default" value="1">
                    <span>Set as default address</span>
                  </label>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-outline-dark text-uppercase">Add Address</button>
                </div>
              </form>
            </div>

            <div class="account-shell" id="password-settings">
              <div class="account-section-head">
                <div>
                  <span class="account-eyebrow">Security</span>
                  <h2 class="account-section-title mb-0">Change Password</h2>
                </div>
              </div>
              <form method="POST" action="{{ route('account.password.update') }}" class="row g-3">
                @csrf
                @method('PUT')
                <div class="col-md-4">
                  <label class="account-label">Current Password *</label>
                  <input type="password" name="current_password" class="form-control" required>
                </div>
                <div class="col-md-4">
                  <label class="account-label">New Password *</label>
                  <input type="password" name="password" class="form-control" required>
                </div>
                <div class="col-md-4">
                  <label class="account-label">Confirm Password *</label>
                  <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-dark text-uppercase">Update Password</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      @else
        @php
          $showRegister = old('name') || old('email');
        @endphp
        <div class="row justify-content-center">
          <div class="col-lg-8 col-xl-7">
            <div class="account-auth-card">
              <span class="account-eyebrow">Sign In</span>
              <h2 class="account-section-title mb-4">Welcome back to your account</h2>
              <form method="POST" action="{{ route('login.attempt') }}" class="form-group flex-wrap">
                @csrf
                <div class="col-lg-12 pb-3">
                  <label class="account-label">Username or Email Address *</label>
                  <input
                    type="text"
                    name="login"
                    value="{{ old('login') }}"
                    placeholder="Write your username / Email address here"
                    class="form-control"
                    required
                  >
                </div>
                <div class="col-lg-12 pb-3">
                  <label class="account-label">Password *</label>
                  <input
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    class="form-control"
                    required
                  >
                </div>
                <div class="col-lg-12 d-flex justify-content-between pb-3">
                  <label class="account-checkbox">
                    <input type="checkbox" name="remember" value="1">
                    <span class="label-body">Remember me</span>
                  </label>
                  <p class="mb-0 account-muted">Use your account email or name to sign in.</p>
                </div>
                <div class="col-lg-12">
                  <button type="submit" class="btn btn-dark btn-lg w-100 text-uppercase">Log in</button>
                </div>
              </form>

              <div class="account-register-inline">
                <span class="account-muted">New here?</span>
                <button
                  class="account-register-toggle"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#register-panel"
                  aria-expanded="{{ $showRegister ? 'true' : 'false' }}"
                  aria-controls="register-panel"
                >
                  Register
                </button>
              </div>

              <div id="register-panel" class="collapse{{ $showRegister ? ' show' : '' }}">
                <div class="account-register-panel">
                  <span class="account-eyebrow">Create Account</span>
                  <h3 class="account-register-title">Create your customer profile</h3>
                  <form method="POST" action="{{ route('register') }}" class="form-group flex-wrap">
                    @csrf
                    <div class="col-lg-12 pb-3">
                      <label class="account-label">Full Name *</label>
                      <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Write your full name here"
                        class="form-control"
                        required
                      >
                    </div>
                    <div class="col-lg-12 pb-3">
                      <label class="account-label">Email Address *</label>
                      <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        class="form-control"
                        required
                      >
                    </div>
                    <div class="col-lg-12 pb-3">
                      <label class="account-label">Password *</label>
                      <input
                        type="password"
                        name="password"
                        placeholder="Create a password"
                        class="form-control"
                        required
                      >
                    </div>
                    <div class="col-lg-12 pb-3">
                      <label class="account-label">Confirm Password *</label>
                      <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirm your password"
                        class="form-control"
                        required
                      >
                    </div>
                    <div class="col-lg-12">
                      <button type="submit" class="btn btn-outline-dark btn-lg w-100 text-uppercase">Register</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endauth
    </div>
  </section>
@endsection
