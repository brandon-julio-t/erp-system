<?php

namespace App\UseCases\Products;

use App\Contracts\UseCase;
use App\Models\Product;

class CreateProductUseCase implements UseCase
{
    function execute(mixed $payload = []): mixed
    {
        return Product::factory()->create($payload);
    }
}
