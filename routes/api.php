<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CatalogController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\NavigationController;
use App\Http\Controllers\Api\StripeWebhookController;
use App\Http\Controllers\Api\SubscribeController;
use Illuminate\Support\Facades\Route;

Route::get('/health', fn () => ['status' => 'ok']);

Route::get('/navigation', [NavigationController::class, 'show']);

Route::prefix('products')->group(function () {
    Route::get('/', [CatalogController::class, 'index']);
    Route::get('/featured', [CatalogController::class, 'featured']);
    Route::get('/trending', [CatalogController::class, 'trending']);
    Route::get('/{productId}', [CatalogController::class, 'show']);
});

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'show']);
    Route::post('/items', [CartController::class, 'store']);
    Route::patch('/items/{productId}', [CartController::class, 'update']);
    Route::delete('/items/{productId}', [CartController::class, 'destroy']);
    Route::delete('/', [CartController::class, 'clear']);
});

Route::post('/coupons/apply', [CouponController::class, 'apply']);
Route::post('/checkout', [CheckoutController::class, 'store']);
Route::post('/stripe/webhook', [StripeWebhookController::class, 'handle']);
Route::post('/contact', [ContactController::class, 'store']);
Route::post('/subscribe', [SubscribeController::class, 'store']);
