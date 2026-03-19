<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class NavigationController extends Controller
{
    public function show(): JsonResponse
    {
        return response()->json([
            'data' => [
                'home' => '/',
                'about' => '/about-us',
                'shop' => '/shop',
                'blog' => '/blog',
                'pages' => [
                    'cart' => '/cart',
                    'checkout' => '/checkout',
                    'contact' => '/contact',
                    'faqs' => '/faqs',
                    'my_account' => '/my-account',
                    'order_tracking' => '/order-tracking',
                    'wishlist' => '/wishlist',
                ],
            ],
        ]);
    }
}

