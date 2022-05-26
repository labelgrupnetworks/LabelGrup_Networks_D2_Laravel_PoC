<?php

namespace App\Api\Products\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryMainRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'main' => 'required|integer'
        ];
    }
}
