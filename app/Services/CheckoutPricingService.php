<?php

namespace App\Services;

class CheckoutPricingService
{
    public const TAX_RATE = 8.5;

    public function __construct(
        private readonly CouponService $coupons,
    ) {
    }

    public function summarize(float $subtotal, ?string $couponCode, string $shippingMethod = 'standard'): array
    {
        $couponSummary = $this->coupons->apply($couponCode, $subtotal);
        $discountedSubtotal = max(0, round($couponSummary['subtotal'] - $couponSummary['discount'], 2));

        $shipping = $this->shippingAmount($discountedSubtotal, $shippingMethod);
        $tax = round(($discountedSubtotal + $shipping) * (self::TAX_RATE / 100), 2);
        $total = round($discountedSubtotal + $shipping + $tax, 2);

        return [
            'coupon' => $couponSummary['coupon'],
            'coupon_code' => $couponSummary['coupon']?->code,
            'discount' => round($couponSummary['discount'], 2),
            'subtotal' => round($subtotal, 2),
            'discounted_subtotal' => $discountedSubtotal,
            'shipping_method' => $shippingMethod,
            'shipping_label' => $this->shippingLabel($shippingMethod),
            'shipping' => $shipping,
            'tax_rate' => self::TAX_RATE,
            'tax' => $tax,
            'total' => $total,
        ];
    }

    public function shippingAmount(float $discountedSubtotal, string $shippingMethod): float
    {
        return match ($shippingMethod) {
            'express' => 18.0,
            default => $discountedSubtotal >= 100 ? 0.0 : 8.0,
        };
    }

    public function shippingLabel(string $shippingMethod): string
    {
        return $shippingMethod === 'express' ? 'Express Shipping' : 'Standard Shipping';
    }
}
