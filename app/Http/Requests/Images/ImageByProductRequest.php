<?php

namespace App\Http\Requests\Images;

use Illuminate\Foundation\Http\FormRequest;

class ImageByProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function attributes() {
        return [
            'id_product' => 'id del producto',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array {
        return [
            'id_product' => 'required',
        ];
    }

    public function messages() {
        return [
            'id_product.required' => 'El :attribute es obligatorio.'
        ];
    }
}