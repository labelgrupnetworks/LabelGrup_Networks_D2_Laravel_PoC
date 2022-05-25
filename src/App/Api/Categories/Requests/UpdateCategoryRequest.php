<?php

namespace App\Api\Categories\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'nullable|string',
            'description' => 'nullable|string'
        ];
    }
}
