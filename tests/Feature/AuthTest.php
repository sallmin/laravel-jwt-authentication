<?php

namespace Tests\Feature;

use App\Events\Auth\UserForgotPasswordEvent;
use App\Models\Auth\PasswordReset;
use App\Models\User;
use Illuminate\Foundation\Testing\Concerns\InteractsWithExceptionHandling;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use InteractsWithExceptionHandling, DatabaseTransactions;

    /** @test */
    public function check_if_user_can_sign_in() : void {
        $user = User::factory()->create();
        $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ])
        ->assertStatus(200);
    }

    /** @test */
    public function check_if_user_can_request_password_reset() : void {
        $user = User::factory()->create();
        $this->expectsEvents(UserForgotPasswordEvent::class);
        $this->postJson('/api/auth/forgot', [
            'email' => $user->email,
            'redirect_url' => 'https://www.example.com',
        ])
        ->assertStatus(200);
    }

    /** @test */
    public function check_if_user_can_change_password() : void {
        $user = User::factory()->create();
        $this->postJson('/api/auth/forgot', [
            'email' => $user->email,
            'redirect_url' => 'https://www.example.com',
        ]);

        $passwordReset = PasswordReset::whereEmail($user->email)->first();
        $this->postJson('/api/auth/change-password', [
            'token' => $passwordReset->token,
            'password' => 'password',
        ])
        ->assertStatus(200);
    }

    /** @test */
    public function check_if_user_can_logout() : void {
        $user = User::factory()->create();
        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->getContent();
        $token = json_decode($response)->access_token;

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])
        ->postJson('api/auth/logout')
        ->assertStatus(200);
    }
}
