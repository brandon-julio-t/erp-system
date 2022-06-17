<?php

namespace Tests\Unit\UseCases\SaleTransaction;

use App\Models\SaleTransactionDetail;
use App\Models\SaleTransactionHeader;
use App\UseCases\SaleTransaction\DeleteSaleTransactionUseCase;
use Tests\TestCase;

class DeleteSaleTransactionUseCaseTest extends TestCase
{
    private DeleteSaleTransactionUseCase $useCase;

    public function test_delete_header_with_details_success()
    {
        $header = SaleTransactionHeader::factory()->create();
        $details = SaleTransactionDetail::factory()->for($header)->count(5)->create();

        $result = $this->useCase->execute($header->getKey());

        $this->assertNotNull($result);
        $this->assertSoftDeleted($header->refresh());
        $details->each(fn(SaleTransactionDetail $detail) => $this->assertSoftDeleted($detail->refresh()));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = $this->app->make(DeleteSaleTransactionUseCase::class);
    }
}
