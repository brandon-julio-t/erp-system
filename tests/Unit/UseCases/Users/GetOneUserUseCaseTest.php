<?php

namespace UseCases\Users;

use App\UseCases\Users\GetOneUserByIDUseCase;
use InvalidArgumentException;
use Tests\TestCase;

class GetOneUserUseCaseTest extends TestCase
{
    private GetOneUserByIDUseCase $useCase;

    public function test_can_handle_null_payload()
    {
        $this->assertThrows(
            fn() => $this->useCase->execute(),
            InvalidArgumentException::class, 'ID is required.'
        );
    }

    public function test_can_handle_payload_without_id()
    {
        $this->assertThrows(
            fn() => $this->useCase->execute(['wrong' => 'attribute']),
            InvalidArgumentException::class, 'ID is required.'
        );
    }

    public function test_find_user_success()
    {
        $foundUser = $this->useCase->execute([$this->user->getKeyName() => $this->user->getKey()]);
        $this->assertTrue($this->user->is($foundUser));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = $this->app->make(GetOneUserByIDUseCase::class);
    }
}
