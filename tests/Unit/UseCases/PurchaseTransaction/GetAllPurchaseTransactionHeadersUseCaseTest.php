<?php

namespace UseCases\PurchaseTransaction;

use App\Models\PurchaseTransactionHeader;
use App\UseCases\PurchaseTransaction\GetAllPurchaseTransactionHeadersUseCase;
use Illuminate\Contracts\Pagination\Paginator;
use Tests\TestCase;

class GetAllPurchaseTransactionHeadersUseCaseTest extends TestCase
{
    private GetAllPurchaseTransactionHeadersUseCase $useCase;

    public function test_get_all_purchase_transaction_headers_success()
    {
        $entities = $this->useCase->execute();
        $this->assertNotNull($entities);
        $this->assertNotEmpty($entities);
        $this->assertTrue($entities instanceof Paginator);
        foreach ($entities->items() as $item) {
            $this->assertTrue($item instanceof PurchaseTransactionHeader);
        }
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = $this->app->make(GetAllPurchaseTransactionHeadersUseCase::class);
    }
}
