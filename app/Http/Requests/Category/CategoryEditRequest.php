<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryEditRequest extends FormRequest
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
            'id_categoru' => 'id de la categoria',
            'name' => 'nombre de la categoria',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array {
        return [
            'id_category' => 'required',
            'name' => 'required|max:254',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'El :attribute es obligatorio.',
            'id_category.required' => 'El :attribute es obligatorio.'
        ];
    }
}