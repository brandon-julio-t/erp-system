<?php

namespace App\UseCases\Users;

use App\Contracts\UseCase;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetAllUsersUseCase implements UseCase
{
    function execute(mixed $payload = null): LengthAwarePaginator
    {
        return User::query()->paginate();
    }
}
