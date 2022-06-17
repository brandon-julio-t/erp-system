<?php

namespace App\UseCases\User;

use App\Contracts\UseCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUserUseCase implements UseCase
{
    function execute(mixed $payload = null): mixed
    {
        $payload['password'] = Hash::make($payload['password']);
        return User::factory()->create($payload);
    }
}
