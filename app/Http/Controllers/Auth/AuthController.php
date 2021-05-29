<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * @var AuthRepository
     */
    protected $repository;

    /**
     * @param AuthRepository $repository
     */
    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->repository->login($request->validated());
    }

    /**
     * Log the user out (Blacklist current token).
     */
    public function logout(): JsonResponse
    {
        return $this->repository->logout();
    }

    /**
     * Refresh a token.
     */
    public function refresh(): JsonResponse
    {
        return $this->repository->refresh();
    }
}
