<?php

namespace Tests\Unit\UseCases\SaleTransaction;

use App\Models\SaleTransactionDetail;
use App\UseCases\SaleTransaction\GetOneSaleTransactionDetailByIdUseCase;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;

class GetOneSaleTransactionDetailByIdUseCaseTest extends TestCase
{
    private GetOneSaleTransactionDetailByIdUseCase $useCase;

    public function test_find_one_success()
    {
        $entity = SaleTransactionDetail::factory()->create();
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
        $this->useCase = $this->app->make(GetOneSaleTransactionDetailByIdUseCase::class);
    }
}
