<?php

namespace UseCases\Products;

use App\Models\Product;
use App\UseCases\Products\DeleteProductUseCase;
use Tests\TestCase;

class DeleteProductUseCaseTest extends TestCase
{
    private DeleteProductUseCase $useCase;

    public function test_product_deleted_successfully()
    {
        $product = Product::factory()->create();
        $entity = $this->useCase->execute($product->getKey());
        $this->assertNotNull($entity);
        $this->assertTrue($entity->is($product));
        $this->assertSoftDeleted($product->refresh());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = $this->app->make(DeleteProductUseCase::class);
    }
}
