<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'email' => 'Correo Electronico',
            'name' => 'Nombre',
            'password' => 'Password',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array {
        return [
            'id_user'   => 'required',
            'email' => 'email',
            'name' => 'max:254',
            'password' => '',
        ];
    }

    public function messages() {
        return [
            'id_user.required' => 'El :attribute es obligatorio.',
            'email.required' => 'El :attribute es obligatorio.',
            'name.required' => 'El :attribute es obligatorio.',
            'password.required' => 'El :attribute es obligatorio.',
        ];
    }
}