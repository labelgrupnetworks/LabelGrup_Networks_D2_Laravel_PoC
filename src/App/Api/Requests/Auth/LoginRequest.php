<?php

namespace App\Api\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Support\Traits\FailedValidationToJson;

class LoginRequest extends FormRequest
{
    use FailedValidationToJson;

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string'
        ];
    }
}
