<?php

namespace App\Api\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Support\Traits\FailedValidationToJson;

class CreateUserRequest extends FormRequest
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
