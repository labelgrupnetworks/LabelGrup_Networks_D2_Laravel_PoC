<?php

namespace App\Http\Requests\API\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|unique:products|max:255',
            'description' => 'required|max:1024',
            'stock' => 'required|integer',
            'price' => 'required|decimal:2',
            'categories' => 'required|array|exists:categories,id',
            'images' => 'nullable',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:1024',
        ];
    }
}
