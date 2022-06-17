<?php

namespace Tests\Unit\UseCases\SaleTransaction;

use App\Models\SaleTransactionDetail;
use App\UseCases\SaleTransaction\GetAllSaleTransactionDetailsUseCase;
use Illuminate\Contracts\Pagination\Paginator;
use Tests\TestCase;

class GetAllSaleTransactionDetailsUseCaseTest extends TestCase
{
    private GetAllSaleTransactionDetailsUseCase $useCase;

    public function test_get_all_purchase_transaction_details_success()
    {
        $entities = $this->useCase->execute();
        $this->assertNotNull($entities);
        $this->assertNotEmpty($entities);
        $this->assertTrue($entities instanceof Paginator);
        foreach ($entities->items() as $item) {
            $this->assertTrue($item instanceof SaleTransactionDetail);
        }
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = $this->app->make(GetAllSaleTransactionDetailsUseCase::class);
    }
}
