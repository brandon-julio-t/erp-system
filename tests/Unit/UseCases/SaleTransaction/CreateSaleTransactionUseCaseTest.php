<?php

namespace Tests\Unit\UseCases\SaleTransaction;

use App\Models\SaleTransactionDetail;
use App\Models\SaleTransactionHeader;
use App\UseCases\SaleTransaction\CreateSaleTransactionUseCase;
use Tests\TestCase;

class CreateSaleTransactionUseCaseTest extends TestCase
{
    private CreateSaleTransactionUseCase $useCase;

    public function test_create_success()
    {
        $header = SaleTransactionHeader::factory()->make();
        $details = SaleTransactionDetail::factory()->for($header)->count(5)->make();
        $previousHeadersCount = SaleTransactionHeader::query()->count();
        $previousDetailsCount = SaleTransactionDetail::query()->count();

        $payload = [
            ...$header->attributesToArray(),
            'details' => $details->map->attributesToArray(),
        ];

        $result = $this->useCase->execute($payload);

        $this->assertNotNull($result);
        $this->assertDatabaseCount($header->getTable(), $previousHeadersCount + 1);
        $this->assertDatabaseCount($details->first()->getTable(), $previousDetailsCount + $details->count());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = $this->app->make(CreateSaleTransactionUseCase::class);
    }
}
