<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CouponApplyRequest;
use App\Services\CartService;
use App\Services\CatalogService;
use App\Services\CheckoutPricingService;
use App\Services\CouponService;
use Illuminate\Http\JsonResponse;

class CouponController extends Controller
{
    public function __construct(
        private readonly CartService $cart,
        private readonly CatalogService $catalog,
        private readonly CouponService $coupons,
        private readonly CheckoutPricingService $pricing,
    ) {
    }

    public function apply(CouponApplyRequest $request): JsonResponse
    {
        $cart = $this->cart->load($request->user()?->id, $request->string('cart_token')->toString());
        $subtotal = $this->subtotal($cart['items']);
        $summary = $this->pricing->summarize(
            subtotal: $subtotal,
            couponCode: $request->string('coupon_code')->toString(),
            shippingMethod: (string) $request->input('shipping_method', 'standard'),
        );

        return response()->json([
            'message' => 'Coupon applied successfully.',
            'coupon_code' => $summary['coupon_code'],
            'discount' => $summary['discount'],
            'subtotal' => $summary['subtotal'],
            'shipping' => $summary['shipping'],
            'tax' => $summary['tax'],
            'total' => $summary['total'],
        ]);
    }

    /**
     * @param array<string, int> $items
     */
    private function subtotal(array $items): float
    {
        $subtotal = 0.0;

        foreach ($items as $productId => $quantity) {
            $product = $this->catalog->find((string) $productId);
            if ($product) {
                $subtotal += ((float) $product['price']) * $quantity;
            }
        }

        return round($subtotal, 2);
    }
}
