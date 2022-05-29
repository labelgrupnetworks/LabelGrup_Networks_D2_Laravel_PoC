<?php

namespace App\Api\Users\Controllers;

use App\Api\Users\Resources\UserResource;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function __invoke(): UserResource
    {
        return UserResource::make(auth()->user());
    }
}
