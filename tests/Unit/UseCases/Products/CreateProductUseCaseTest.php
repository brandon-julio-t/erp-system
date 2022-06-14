<?php

namespace UseCases\Products;

use App\Models\Product;
use App\UseCases\Products\CreateProductUseCase;
use Tests\TestCase;

class CreateProductUseCaseTest extends TestCase
{
    private CreateProductUseCase $useCase;

    public function test_product_created_successfully()
    {
        $product = Product::factory()->make();
        $entity = $this->useCase->execute($product->attributesToArray());
        $this->assertNotNull($entity);
        $this->assertDatabaseHas($product->getTable(), $product->attributesToArray());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = $this->app->make(CreateProductUseCase::class);
    }
}
