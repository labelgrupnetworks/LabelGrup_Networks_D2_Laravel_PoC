<?php

namespace App\Api\Auth\Requests;

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
