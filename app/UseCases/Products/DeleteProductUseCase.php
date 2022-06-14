<?php

namespace App\UseCases\Products;

use App\Contracts\UseCase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class DeleteProductUseCase implements UseCase
{
    public function __construct(private readonly GetOneProductByIDUseCase $getOneProductByIDUseCase)
    {
    }

    function execute(mixed $payload = null): Builder|Model
    {
        $entity = $this->getOneProductByIDUseCase->execute($payload);
        $entity->delete();
        return $entity;
    }
}
