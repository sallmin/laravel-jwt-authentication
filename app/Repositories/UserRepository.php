<?php

namespace App\Repositories;

use App\Http\Resources\UserResource;

class UserRepository
{
    public function show(): UserResource
    {
        return new UserResource(auth()->user());
    }
}
