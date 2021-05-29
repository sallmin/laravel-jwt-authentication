<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Repositories\Auth\ResetRepository;
use Illuminate\Http\JsonResponse;

class ResetController extends Controller
{
    /**
     * @var ResetRepository
     */
    protected $repository;

    /**
     * @param ResetRepository $repository
     */
    public function __construct(ResetRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Forgot password request
     *
     * @param ForgotPasswordRequest $request
     * @return JsonResponse
     */
    public function forgot(ForgotPasswordRequest $request): JsonResponse
    {
        return $this->repository->forgot($request->validated());
    }

    /**
     * Change password request
     *
     * @param ChangePasswordRequest $request
     * @return JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        return $this->repository->changePassword($request->validated());
    }
}
