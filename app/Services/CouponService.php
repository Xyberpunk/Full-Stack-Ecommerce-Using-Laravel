<?php

namespace App\Services;

use App\Models\Coupon;
use Illuminate\Validation\ValidationException;

class CouponService
{
    public function apply(?string $code, float $subtotal): array
    {
        if (!$code) {
            return [
                'coupon' => null,
                'discount' => 0.0,
                'subtotal' => $subtotal,
                'total' => $subtotal,
            ];
        }

        $coupon = Coupon::query()
            ->where('code', strtoupper(trim($code)))
            ->first();

        if (!$coupon || !$coupon->is_active) {
            throw ValidationException::withMessages([
                'coupon_code' => 'Coupon code is invalid.',
            ]);
        }

        $now = now();

        if ($coupon->starts_at && $coupon->starts_at->isFuture()) {
            throw ValidationException::withMessages([
                'coupon_code' => 'Coupon is not active yet.',
            ]);
        }

        if ($coupon->ends_at && $coupon->ends_at->isPast()) {
            throw ValidationException::withMessages([
                'coupon_code' => 'Coupon has expired.',
            ]);
        }

        if ($coupon->usage_limit !== null && $coupon->used_count >= $coupon->usage_limit) {
            throw ValidationException::withMessages([
                'coupon_code' => 'Coupon usage limit has been reached.',
            ]);
        }

        if ($subtotal < (float) $coupon->min_order_amount) {
            throw ValidationException::withMessages([
                'coupon_code' => 'Order does not meet the minimum amount for this coupon.',
            ]);
        }

        $discount = $coupon->type === 'percent'
            ? round($subtotal * (((float) $coupon->value) / 100), 2)
            : min($subtotal, (float) $coupon->value);

        $total = max(0, round($subtotal - $discount, 2));

        return [
            'coupon' => $coupon,
            'discount' => $discount,
            'subtotal' => round($subtotal, 2),
            'total' => $total,
        ];
    }
}
