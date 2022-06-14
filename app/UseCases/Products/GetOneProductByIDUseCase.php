<?php

namespace App\UseCases\Products;

use App\Contracts\UseCase;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetOneProductByIDUseCase implements UseCase
{
    function execute(mixed $payload = null): Builder|Model
    {
        return Product::query()->findOrFail($payload);
    }
}
