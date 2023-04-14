<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->guest();
    }

    public function attributes() {
        return [
            'email' => 'Correo Electronico',
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
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function messages() {
        return [
            'email.required' => 'El :attribute es obligatorio.',
            'password.required' => 'El :attribute es obligatorio.',
        ];
    }
}