<?php

namespace UseCases\Products;

use App\Models\Product;
use App\UseCases\Product\GetAllProductsUseCase;
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
        foreach ($products->items() as $item) {
            $this->assertTrue($item instanceof Product);
        }
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = $this->app->make(GetAllProductsUseCase::class);
    }
}
