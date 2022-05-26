<?php

namespace App\Api\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email,'.$this->user->id,
            'password' => 'nullable|string',
        ];
    }
}
