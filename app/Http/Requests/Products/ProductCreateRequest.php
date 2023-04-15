<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array {
        return [
            'sku'                   => 'required|unique:products|max:255',
            'name'                  => 'required|max:255',
            'description'           => 'max:255',
            'id_category'           => 'required|exists:categories,id_category',
            'secondary_categories'  => '',
            'price'                 => 'required|numeric',
            'stock'                 => 'numeric|min:0',
            'images'                => ''
        ];
    }
}