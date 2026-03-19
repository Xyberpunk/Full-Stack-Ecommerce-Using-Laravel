<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CouponApplyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cart_token' => ['required', 'string', 'max:255'],
            'coupon_code' => ['nullable', 'string', 'max:100'],
            'shipping_method' => ['nullable', 'in:standard,express'],
        ];
    }
}
