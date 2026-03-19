<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;

class ProductUpdateRequest extends ProductStoreRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        $rules['sku'] = [
            'nullable',
            'string',
            'max:100',
            Rule::unique('products', 'sku')->ignore($this->route('product')?->id),
        ];

        return $rules;
    }
}
