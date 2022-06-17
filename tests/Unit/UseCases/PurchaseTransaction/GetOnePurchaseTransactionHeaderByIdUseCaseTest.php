<?php

namespace UseCases\PurchaseTransaction;

use App\Models\PurchaseTransactionHeader;
use App\UseCases\PurchaseTransaction\GetOnePurchaseTransactionHeaderByIdUseCase;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;

class GetOnePurchaseTransactionHeaderByIdUseCaseTest extends TestCase
{
    private GetOnePurchaseTransactionHeaderByIdUseCase $useCase;

    public function test_find_one_success()
    {
        $entity = PurchaseTransactionHeader::factory()->create();
        $result = $this->useCase->execute($entity->getKey());
        $this->assertTrue($result->is($entity));
    }

    public function test_find_invalid_id_throws_error()
    {
        $this->assertThrows(fn() => $this->useCase->execute(), ModelNotFoundException::class);
        $this->assertThrows(fn() => $this->useCase->execute(0), ModelNotFoundException::class);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = $this->app->make(GetOnePurchaseTransactionHeaderByIdUseCase::class);
    }
}
