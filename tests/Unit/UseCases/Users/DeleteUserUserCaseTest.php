<?php

namespace UseCases\Users;

use App\UseCases\User\DeleteUserUseCase;
use InvalidArgumentException;
use Tests\TestCase;

class DeleteUserUserCaseTest extends TestCase
{
    private DeleteUserUseCase $useCase;

    public function test_user_deleted_successfully()
    {
        $payload = [
            $this->user->getKeyName() => $this->user->getKey()
        ];

        $deletedUser = $this->useCase->execute($payload);

        $this->assertTrue($this->user->is($deletedUser));
        $this->assertSoftDeleted($this->user->refresh());
    }

    public function test_delete_non_existent_user_throws_exception()
    {
        $this->assertThrows(
            fn() => $this->useCase->execute(),
            InvalidArgumentException::class, 'ID is required.'
        );
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = $this->app->make(DeleteUserUseCase::class);
    }
}
