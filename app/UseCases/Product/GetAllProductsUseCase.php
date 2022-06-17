<?php

namespace App\UseCases\Product;

use App\Contracts\UseCase;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetAllProductsUseCase implements UseCase
{
    function execute(mixed $payload = null): LengthAwarePaginator
    {
        return Product::query()->paginate();
    }
}
