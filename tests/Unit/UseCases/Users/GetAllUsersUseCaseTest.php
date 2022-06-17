<?php

namespace Tests\Unit\UseCases\Users;

use App\Models\User;
use App\UseCases\User\GetAllUsersUseCase;
use Illuminate\Contracts\Pagination\Paginator;
use Tests\TestCase;

class GetAllUsersUseCaseTest extends TestCase
{
    private GetAllUsersUseCase $useCase;

    public function test_execute_success()
    {
        $result = $this->useCase->execute();
        $this->assertNotNull($result);
        $this->assertNotEmpty($result);
        $this->assertTrue($result instanceof Paginator);
        foreach ($result->items() as $item) {
            $this->assertTrue($item instanceof User);
        }
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = $this->app->make(GetAllUsersUseCase::class);
    }
}
