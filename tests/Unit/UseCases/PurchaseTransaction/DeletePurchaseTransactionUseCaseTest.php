<?php

namespace UseCases\PurchaseTransaction;

use App\Models\PurchaseTransactionDetail;
use App\Models\PurchaseTransactionHeader;
use App\UseCases\PurchaseTransaction\DeletePurchaseTransactionUseCase;
use Tests\TestCase;

class DeletePurchaseTransactionUseCaseTest extends TestCase
{
    private DeletePurchaseTransactionUseCase $useCase;

    public function test_delete_header_with_details_success()
    {
        $header = PurchaseTransactionHeader::factory()->create();
        $details = PurchaseTransactionDetail::factory()->for($header)->count(5)->create();

        $result = $this->useCase->execute($header->getKey());

        $this->assertNotNull($result);
        $this->assertSoftDeleted($header->refresh());
        $details->each(fn(PurchaseTransactionDetail $detail) => $this->assertSoftDeleted($detail->refresh()));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = $this->app->make(DeletePurchaseTransactionUseCase::class);
    }
}
