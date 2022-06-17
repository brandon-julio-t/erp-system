<?php

namespace App\UseCases\User;

use App\Contracts\UseCase;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;

class GetCurrentUserUseCase implements UseCase
{
    function execute(mixed $payload = null): User|Authenticatable|null
    {
        return $payload instanceof Request
            ? $payload->user()
            : auth()->user();
    }
}
