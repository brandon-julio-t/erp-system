<?php

namespace Http\Controllers;

use App\Models\Product;
use App\UseCases\Products\CreateProductUseCase;
use App\UseCases\Products\DeleteProductUseCase;
use App\UseCases\Products\GetAllProductsUseCase;
use App\UseCases\Products\GetOneProductByIDUseCase;
use App\UseCases\Products\UpdateProductUseCase;
use Laravel\Passport\Passport;
use Mockery\MockInterface;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    public function test_index_function_is_correct()
    {
        $this->mock(
            GetAllProductsUseCase::class,
            fn(MockInterface $mock) => $this->mockUseCase($mock, Product::query()->paginate()),
        );

        $route = route('products.index');

        $this->getJson($route)->assertUnauthorized();

        Passport::actingAs($this->user, ['']);
        $this->getJson($route)->assertForbidden();

        Passport::actingAs($this->user, ['read-product']);
        $this->getJson($route)->assertOk();
    }

    public function test_store_function_is_correct()
    {

        $route = route('products.store');
        $product = Product::factory()->make();
        $payload = $product->attributesToArray();

        $this->mock(
            CreateProductUseCase::class,
            fn(MockInterface $mock) => $this->mockUseCase($mock, $product),
        );

        $this->postJson($route, $payload)->assertUnauthorized();

        Passport::actingAs($this->user, ['']);
        $this->postJson($route, $payload)->assertForbidden();

        Passport::actingAs($this->user, ['create-product']);
        $this->postJson($route, $payload)->assertOk();
    }

    public function test_show_function_is_correct()
    {
        $product = Product::factory()->create();

        $this->mock(
            GetOneProductByIDUseCase::class,
            fn(MockInterface $mock) => $this->mockUseCase($mock, $product),
        );

        $route = route('products.show', $product);

        $this->getJson($route)->assertUnauthorized();

        Passport::actingAs($this->user, ['']);
        $this->getJson($route)->assertForbidden();

        Passport::actingAs($this->user, ['read-product']);
        $this->getJson($route)->assertOk();
    }

    public function test_update_function_is_correct()
    {
        $product = Product::factory()->create();
        $payload = $product->attributesToArray();

        $this->mock(
            UpdateProductUseCase::class,
            fn(MockInterface $mock) => $this->mockUseCase($mock, $product),
        );

        $route = route('products.update', $product);

        $this->putJson($route, $payload)->assertUnauthorized();

        Passport::actingAs($this->user, ['']);
        $this->putJson($route, $payload)->assertForbidden();

        Passport::actingAs($this->user, ['update-product']);
        $this->putJson($route, $payload)->assertOk();
    }

    public function test_destroy_function_is_correct()
    {
        $product = Product::factory()->create();

        $this->mock(
            DeleteProductUseCase::class,
            fn(MockInterface $mock) => $this->mockUseCase($mock, $product),
        );

        $route = route('products.destroy', $product);

        $this->deleteJson($route)->assertUnauthorized();

        Passport::actingAs($this->user, ['']);
        $this->deleteJson($route)->assertForbidden();

        Passport::actingAs($this->user, ['delete-product']);
        $this->deleteJson($route)->assertOk();
    }
}
