<?php

namespace UseCases\Products;

use App\Models\Product;
use App\UseCases\Products\GetOneProductByIDUseCase;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;

class GetOneProductByIDUseCaseTest extends TestCase
{
    private GetOneProductByIDUseCase $useCase;

    public function test_can_handle_invalid_payload()
    {
        $this->assertThrows(
            fn() => $this->useCase->execute(),
            ModelNotFoundException::class,
        );

        $this->assertThrows(
            fn() => $this->useCase->execute(0),
            ModelNotFoundException::class,
        );
    }

    public function test_get_one_product_by_id_success()
    {
        $product = Product::factory()->create();
        $found = $this->useCase->execute($product->getKey());
        $this->assertNotNull($found);
        $this->assertTrue($found->is($product));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = $this->app->make(GetOneProductByIDUseCase::class);
    }
}
