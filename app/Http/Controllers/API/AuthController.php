<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\AuthLoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $authLoginRequest): JsonResponse
    {
        $credentials = $authLoginRequest->validated();

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'The provided credentials does not match our records.',
                'code' => 'LabelGroup:FAILED'
            ], Response::HTTP_FORBIDDEN);
        }

        return response()->json([
            'token' => $authLoginRequest->user()->createToken($authLoginRequest->ip())->plainTextToken,
            'code' => 'LabelGroup:OK'
        ], Response::HTTP_OK);
    }

    public function logout(): JsonResponse
    {
        request()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Token has been deleted successfully.',
            'code' => 'LabelGroup:OK'
        ], Response::HTTP_OK);
    }
}
