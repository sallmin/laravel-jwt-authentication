<?php

namespace App\Repositories\Auth;

use App\Events\Auth\UserForgotPasswordEvent;
use App\Models\Auth\PasswordReset;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class ResetRepository
{
    public function forgot($data): JsonResponse
    {
        $user = User::whereEmail($data['email'])->first();

        $passwordReset = PasswordReset::updateOrCreate([
            'email' => $data['email'],
        ], [
            'email' => $data['email'],
            'token' => sha1($data['email']. microtime(true)) . md5(mt_rand(1000, 100000)),
        ]);

        event(new UserForgotPasswordEvent($user, $passwordReset->token));

        return response()->json([
            'message' => 'Password reset',
        ]);
    }

    public function changePassword($data): JsonResponse
    {
        $passwordReset = PasswordReset::where('token', $data['token'])->first();
        $user = User::whereEmail($passwordReset->email)->first();
        $user->update([
            'password' => bcrypt($data['password']),
        ]);
        $passwordReset->delete();

        return response()->json([
            'message' => 'Password reset',
        ]);
    }
}
