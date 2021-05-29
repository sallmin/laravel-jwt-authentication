<?php

namespace App\Http\Controllers;

use App\Repositories\DashboardRepository;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    /**
     * @var DashboardRepository
     */
    protected $repository;

    /**
     * @param DashboardRepository  $repository
     */
    public function __construct(DashboardRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Fetch dashboard data
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->repository->index();
    }
}
