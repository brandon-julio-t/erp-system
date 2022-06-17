<?php

namespace Http\Controllers;

use App\Models\PurchaseTransactionDetail;
use App\Models\PurchaseTransactionHeader;
use App\UseCases\PurchaseTransaction\CreatePurchaseTransactionUseCase;
use App\UseCases\PurchaseTransaction\DeletePurchaseTransactionUseCase;
use App\UseCases\PurchaseTransaction\GetAllPurchaseTransactionHeadersUseCase;
use App\UseCases\PurchaseTransaction\GetOnePurchaseTransactionHeaderByIdUseCase;
use Laravel\Passport\Passport;
use Mockery\MockInterface;
use Tests\TestCase;

class PurchaseTransactionHeaderControllerTest extends TestCase
{
    public function test_index_function_is_correct()
    {
        $this->mock(
            GetAllPurchaseTransactionHeadersUseCase::class,
            fn(MockInterface $mock) => $this->mockUseCase($mock, PurchaseTransactionHeader::query()->paginate()),
        );

        $route = route('purchase-transactions.index');

        $this->getJson($route)->assertUnauthorized();

        Passport::actingAs($this->user, ['']);
        $this->getJson($route)->assertForbidden();

        Passport::actingAs($this->user, ['read-purchase-transaction']);
        $this->getJson($route)->assertOk();
    }

    public function test_store_function_is_correct()
    {
        $route = route('purchase-transactions.store');
        $header = PurchaseTransactionHeader::factory()->make();
        $details = PurchaseTransactionDetail::factory()->count(5)->make();
        $payload = [
            ...$header->attributesToArray(),
            'details' => $details,
        ];

        $this->mock(
            CreatePurchaseTransactionUseCase::class,
            fn(MockInterface $mock) => $this->mockUseCase($mock, $header),
        );

        $this->postJson($route, $payload)->assertUnauthorized();

        Passport::actingAs($this->user, ['']);
        $this->postJson($route, $payload)->assertForbidden();

        Passport::actingAs($this->user, ['create-purchase-transaction']);
        $this->postJson($route, $payload)->assertOk();
    }

    public function test_show_function_is_correct()
    {
        $entity = PurchaseTransactionHeader::factory()->create();

        $this->mock(
            GetOnePurchaseTransactionHeaderByIdUseCase::class,
            fn(MockInterface $mock) => $this->mockUseCase($mock, $entity),
        );

        $route = route('purchase-transactions.show', $entity);

        $this->getJson($route)->assertUnauthorized();

        Passport::actingAs($this->user, ['']);
        $this->getJson($route)->assertForbidden();

        Passport::actingAs($this->user, ['read-purchase-transaction']);
        $this->getJson($route)->assertOk();
    }

    public function test_destroy_function_is_correct()
    {
        $entity = PurchaseTransactionHeader::factory()->create();

        $this->mock(
            DeletePurchaseTransactionUseCase::class,
            fn(MockInterface $mock) => $this->mockUseCase($mock, $entity),
        );

        $route = route('purchase-transactions.destroy', $entity);

        $this->deleteJson($route)->assertUnauthorized();

        Passport::actingAs($this->user, ['']);
        $this->deleteJson($route)->assertForbidden();

        Passport::actingAs($this->user, ['delete-purchase-transaction']);
        $this->deleteJson($route)->assertOk();
    }

}
