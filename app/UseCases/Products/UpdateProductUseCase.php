<?php

namespace App\UseCases\Products;

use App\Contracts\UseCase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UpdateProductUseCase implements UseCase
{
    public function __construct(private readonly GetOneProductByIDUseCase $getOneProductByIDUseCase)
    {
    }

    function execute(mixed $payload = []): Builder|Model
    {
        $entity = $this->getOneProductByIDUseCase->execute($payload['id']);
        $entity->fill($payload['data']);
        $entity->save();
        return $entity;
    }
}
