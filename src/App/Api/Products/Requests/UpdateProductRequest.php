<?php

namespace App\Api\Products\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'nullable|string',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'stock' => 'nullable|integer',
            'images' => 'nullable|array',
            'categories' => 'nullable|array',
            'categories.*' => 'nullable|exists:categories,id',
            'category_main' => 'nullable|exists:categories,id',
        ];
    }
}
