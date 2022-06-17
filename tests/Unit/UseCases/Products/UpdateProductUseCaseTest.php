<?php

namespace UseCases\Products;

use App\Models\Product;
use App\UseCases\Product\UpdateProductUseCase;
use Tests\TestCase;

class UpdateProductUseCaseTest extends TestCase
{
    private UpdateProductUseCase $useCase;

    public function test_update_success()
    {
        $product = Product::factory()->create();
        $newProduct = Product::factory()->make([$product->getKeyName() => $product->getKey()]);
        $result = $this->useCase->execute([
            'id' => $product->getKey(),
            'data' => $newProduct->attributesToArray(),
        ]);
        $this->assertNotNull($result);
        $this->assertDatabaseHas($newProduct->getTable(), $newProduct->attributesToArray());
        $this->assertDatabaseMissing($product->getTable(), $product->attributesToArray());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = $this->app->make(UpdateProductUseCase::class);
    }
}
