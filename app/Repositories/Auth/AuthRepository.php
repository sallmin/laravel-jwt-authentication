<?php

namespace App\Repositories\Auth;

use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthRepository
{
    public function login($credentials): JsonResponse
    {
        $token = auth()->attempt($credentials);

        if(!$token) {
            return response()->json([
                'errors' => [
                    'login' => 'Email or password wrong'
                ]
            ], 422);
        }

        return response()->json([
            'access_token' => $token,
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json([
            'message' => 'Logged out',
        ]);
    }

    public function refresh(): JsonResponse
    {
        return response()->json([
            'access_token' => auth()->refresh(),
        ]);
    }
}
