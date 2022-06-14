<?php

namespace UseCases\Products;

use App\UseCases\Products\GetAllProductsUseCase;
use Illuminate\Contracts\Pagination\Paginator;
use Tests\TestCase;

class GetAllProductsUseCaseTest extends TestCase
{
    private GetAllProductsUseCase $useCase;

    public function test_get_all_products_success()
    {
        $products = $this->useCase->execute();
        $this->assertNotNull($products);
        $this->assertNotEmpty($products);
        $this->assertTrue($products instanceof Paginator);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = $this->app->make(GetAllProductsUseCase::class);
    }
}
