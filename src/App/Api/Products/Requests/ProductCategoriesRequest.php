<?php

namespace App\Api\Products\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoriesRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id'
        ];
    }
}
