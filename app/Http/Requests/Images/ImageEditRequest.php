<?php

namespace App\Http\Requests\Images;

use Illuminate\Foundation\Http\FormRequest;

class ImageEditRequest extends FormRequest
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
            'id_image' => 'id de la categoria',
            'images' => 'nombre de la categoria',
            'id_product' => 'nombre de la categoria',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array {
        return [
            'id_image' => 'required',
            'images' => '',
            'id_product' => '',
        ];
    }

    public function messages() {
        return [
            'id_image.required' => 'El :attribute es obligatorio.',
            'images.required' => 'El :attribute es obligatorio.',
            'id_product.required' => 'El :attribute es obligatorio.'
        ];
    }
}