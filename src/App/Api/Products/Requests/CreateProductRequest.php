<?php

namespace App\Api\Products\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'images' => 'nullable|array',
            'categories' => 'nullable|array',
            'categories.*' => 'nullable|exists:categories,id',
            'category_main' => 'nullable|exists:categories,id',
        ];
    }
}
