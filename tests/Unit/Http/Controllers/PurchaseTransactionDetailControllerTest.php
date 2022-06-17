<?php

namespace Http\Controllers;

use App\Models\PurchaseTransactionDetail;
use App\Models\PurchaseTransactionHeader;
use App\UseCases\PurchaseTransaction\GetAllPurchaseTransactionDetailsUseCase;
use App\UseCases\PurchaseTransaction\GetOnePurchaseTransactionDetailByIdUseCase;
use Laravel\Passport\Passport;
use Mockery\MockInterface;
use Tests\TestCase;

class PurchaseTransactionDetailControllerTest extends TestCase
{
    private PurchaseTransactionHeader $purchaseTransactionHeader;

    public function test_index_function_is_correct()
    {
        $this->mock(
            GetAllPurchaseTransactionDetailsUseCase::class,
            fn(MockInterface $mock) => $this->mockUseCase($mock, PurchaseTransactionDetail::query()->paginate()),
        );

        $route = route('purchase-transactions.details.index', $this->purchaseTransactionHeader);

        $this->getJson($route)->assertUnauthorized();

        Passport::actingAs($this->user, ['']);
        $this->getJson($route)->assertForbidden();

        Passport::actingAs($this->user, ['read-purchase-transaction']);
        $this->getJson($route)->assertOk();
    }

    public function test_show_function_is_correct()
    {
        $entity = $this->purchaseTransactionHeader->purchaseTransactionDetails()->first();

        $this->mock(
            GetOnePurchaseTransactionDetailByIdUseCase::class,
            fn(MockInterface $mock) => $this->mockUseCase($mock, $entity),
        );

        $route = route('purchase-transactions.details.show', [$this->purchaseTransactionHeader, $entity]);

        $this->getJson($route)->assertUnauthorized();

        Passport::actingAs($this->user, ['']);
        $this->getJson($route)->assertForbidden();

        Passport::actingAs($this->user, ['read-purchase-transaction']);
        $this->getJson($route)->assertOk();
    }


    protected function setUp(): void
    {
        parent::setUp();

        $this->purchaseTransactionHeader = PurchaseTransactionHeader::factory()
            ->has(PurchaseTransactionDetail::factory()->count(5))
            ->create();
    }
}
