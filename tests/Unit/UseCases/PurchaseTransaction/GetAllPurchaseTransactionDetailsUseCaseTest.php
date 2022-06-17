<?php

namespace UseCases\PurchaseTransaction;

use App\Models\PurchaseTransactionDetail;
use App\UseCases\PurchaseTransaction\GetAllPurchaseTransactionDetailsUseCase;
use Illuminate\Contracts\Pagination\Paginator;
use Tests\TestCase;

class GetAllPurchaseTransactionDetailsUseCaseTest extends TestCase
{
    private GetAllPurchaseTransactionDetailsUseCase $useCase;

    public function test_get_all_purchase_transaction_details_success()
    {
        $entities = $this->useCase->execute();
        $this->assertNotNull($entities);
        $this->assertNotEmpty($entities);
        $this->assertTrue($entities instanceof Paginator);
        foreach ($entities->items() as $item) {
            $this->assertTrue($item instanceof PurchaseTransactionDetail);
        }
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = $this->app->make(GetAllPurchaseTransactionDetailsUseCase::class);
    }
}
