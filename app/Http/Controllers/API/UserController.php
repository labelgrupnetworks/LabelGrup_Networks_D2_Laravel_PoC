<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Users\UserLoginRequest;
use App\Http\Requests\Users\UserRegisterRequest;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request) : JsonResponse
    {
        $validated = $request->validated();
        $validated["password"] = Hash::make($validated["password"]);
        
        if(User::create($validated)) {
            return response()->json([
                "success" => true
            ], Response::HTTP_OK);
        }

        return response()->json([
            "success" => false
        ], Response::HTTP_FORBIDDEN);
    }

    public function login(UserLoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'success' => false
            ], Response::HTTP_FORBIDDEN);
        }

        return response()->json([
            'success' => true,
            'token' => $request->user()->createToken($request->ip())->plainTextToken
        ], Response::HTTP_OK);
    }

    public function logout(): JsonResponse
    {
        Auth::logout();

        return response()->json([
            'success' => true
        ], Response::HTTP_OK);
    }
}
