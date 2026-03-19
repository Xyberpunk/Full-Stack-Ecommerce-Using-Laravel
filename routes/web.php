<?php

use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\StorefrontController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StorefrontController::class, 'home'])->name('home');

Route::view('/about-us', 'user.about-us')->name('about');
Route::get('/shop', [StorefrontController::class, 'shop'])->name('shop');
Route::get('/blog', [StorefrontController::class, 'blog'])->name('blog');

Route::view('/cart', 'user.cart')->name('cart');
Route::view('/checkout', 'user.checkout')->name('checkout');

Route::get('/my-account', [AccountController::class, 'dashboard'])->name('account');

Route::get('/login', fn () => redirect()->route('account'))->name('login');

Route::view('/faqs', 'user.faqs')->name('faqs');
Route::view('/contact', 'user.contact')->name('contact');
Route::view('/error-page', 'user.error-page')->name('error');

Route::get('/single-post', [StorefrontController::class, 'latestBlogRedirect'])->name('single-post');
Route::get('/single-post/{blog:slug}', [StorefrontController::class, 'blogShow'])->name('blog.show');
Route::get('/single-product', [StorefrontController::class, 'featuredProductRedirect'])->name('single-product');
Route::get('/single-product/{product:slug}', [StorefrontController::class, 'product'])->name('product.show');

Route::middleware('guest')->group(function (): void {
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function (): void {
    Route::get('/wishlist', [AccountController::class, 'wishlist'])->name('account.wishlist');
    Route::post('/wishlist/{product}', [AccountController::class, 'storeWishlistItem'])->name('account.wishlist.store');
    Route::delete('/wishlist/{wishlistItem}', [AccountController::class, 'destroyWishlistItem'])->name('account.wishlist.destroy');
    Route::delete('/wishlist/product/{product}', [AccountController::class, 'destroyWishlistProduct'])->name('account.wishlist.destroy-product');
    Route::get('/order-tracking', [AccountController::class, 'orders'])->name('account.orders');
    Route::get('/order-tracking/{order}', [AccountController::class, 'showOrder'])->name('account.orders.show');
    Route::post('/order-tracking/{order}/cancel-request', [AccountController::class, 'requestCancellation'])->name('account.orders.cancel-request');
    Route::put('/my-account/profile', [AccountController::class, 'updateProfile'])->name('account.profile.update');
    Route::put('/my-account/password', [AccountController::class, 'updatePassword'])->name('account.password.update');
    Route::post('/my-account/addresses', [AccountController::class, 'storeAddress'])->name('account.addresses.store');
    Route::put('/my-account/addresses/{address}', [AccountController::class, 'updateAddress'])->name('account.addresses.update');
    Route::delete('/my-account/addresses/{address}', [AccountController::class, 'destroyAddress'])->name('account.addresses.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('products', ProductController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('coupons', CouponController::class)->except(['show']);

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::resource('blog', BlogPostController::class)->except(['show'])->parameters([
        'blog' => 'blog',
    ]);
});
