<?php

namespace App\UseCases\User;

use App\Contracts\UseCase;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetOneUserByIdUseCase implements UseCase
{
    function execute(mixed $payload = null): array|null|Builder|Collection|Model
    {
        if (!$payload || !isset($payload['id'])) {
            throw new InvalidArgumentException('ID is required.');
        }

        $entity = User::query()->find($payload['id']);

        if (!$entity) {
            throw new NotFoundHttpException("User with ID {$payload['id']} not found.");
        }

        return $entity;
    }
}
