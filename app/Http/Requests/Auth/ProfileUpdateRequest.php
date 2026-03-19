<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user()?->id),
            ],
            'phone' => ['nullable', 'string', 'max:50'],
            'default_payment_method' => ['nullable', Rule::in(['cod', 'bank_transfer', 'stripe'])],
            'preferred_shipping_method' => ['nullable', Rule::in(['standard', 'express'])],
            'profile_photo' => ['nullable', 'image', 'max:4096'],
        ];
    }
}
