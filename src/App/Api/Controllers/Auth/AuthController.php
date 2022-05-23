<?php

namespace App\Api\Controllers\Auth;

use App\Api\Controllers\Controller;
use App\Api\Requests\Auth\CreateUserRequest;
use App\Api\Requests\Auth\LoginRequest;
use App\Api\Resources\User\UserResource;
use Domain\Users\Actions\CreateUserAction;
use Domain\Users\DTO\UserData;
use Domain\Users\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(CreateUserRequest $request, CreateUserAction $createUserAction): UserResource
    {
        $data = new UserData(...$request->validated());
        $user = ($createUserAction)($data);
        return new UserResource($user);
    }

    public function login(LoginRequest $request): UserResource|JsonResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = User::whereEmail($request->email)->firstOrFail();
        return new UserResource($user);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'You have successfully logged out and the token was successfully deleted']);
    }
}
