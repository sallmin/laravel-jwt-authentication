<?php

namespace App\Repositories;

use Illuminate\Http\JsonResponse;

class DashboardRepository
{
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'dashboard!',
        ]);
    }
}
