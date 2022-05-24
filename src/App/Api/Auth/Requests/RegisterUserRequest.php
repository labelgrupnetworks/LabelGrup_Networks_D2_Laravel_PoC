<?php

namespace App\Api\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Support\Traits\FailedValidationToJson;

class RegisterUserRequest extends FormRequest
{
    use FailedValidationToJson;

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ];
    }


}
