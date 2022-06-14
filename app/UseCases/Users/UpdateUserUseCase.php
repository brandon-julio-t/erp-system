<?php

namespace App\UseCases\Users;

use App\Contracts\UseCase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UpdateUserUseCase implements UseCase
{
    public function __construct(private readonly GetOneUserByIDUseCase $getOneUserByIDUseCase)
    {
    }

    function execute(mixed $payload = null): array|null|Builder|Collection|Model
    {
        $user = $this->getOneUserByIDUseCase->execute(['id' => $payload['id']]);
        $user->fill($payload['data']);
        $user->save();
        return $user;
    }
}
