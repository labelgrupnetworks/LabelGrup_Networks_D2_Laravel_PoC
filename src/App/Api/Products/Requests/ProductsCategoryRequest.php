<?php

namespace App\Api\Products\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'categories' => 'required|string|regex:/^[\d\s,]*$/'
        ];
    }
}
