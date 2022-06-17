<?php

namespace Tests\Unit\UseCases\SaleTransaction;

use App\Models\SaleTransactionHeader;
use App\UseCases\SaleTransaction\GetAllSaleTransactionHeadersUseCase;
use Illuminate\Contracts\Pagination\Paginator;
use Tests\TestCase;

class GetAllSaleTransactionHeadersUseCaseTest extends TestCase
{
    private GetAllSaleTransactionHeadersUseCase $useCase;

    public function test_get_all_purchase_transaction_headers_success()
    {
        $entities = $this->useCase->execute();
        $this->assertNotNull($entities);
        $this->assertNotEmpty($entities);
        $this->assertTrue($entities instanceof Paginator);
        foreach ($entities->items() as $item) {
            $this->assertTrue($item instanceof SaleTransactionHeader);
        }
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = $this->app->make(GetAllSaleTransactionHeadersUseCase::class);
    }
}
