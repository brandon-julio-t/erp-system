<?php

namespace UseCases\PurchaseTransaction;

use App\Models\PurchaseTransactionDetail;
use App\Models\PurchaseTransactionHeader;
use App\UseCases\PurchaseTransaction\CreatePurchaseTransactionUseCase;
use Tests\TestCase;

class CreatePurchaseTransactionUseCaseTest extends TestCase
{
    private CreatePurchaseTransactionUseCase $useCase;

    public function test_create_success()
    {
        $header = PurchaseTransactionHeader::factory()->make();
        $details = PurchaseTransactionDetail::factory()->for($header)->count(5)->make();
        $previousHeadersCount = PurchaseTransactionHeader::query()->count();
        $previousDetailsCount = PurchaseTransactionDetail::query()->count();

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
        $this->useCase = $this->app->make(CreatePurchaseTransactionUseCase::class);
    }
}
