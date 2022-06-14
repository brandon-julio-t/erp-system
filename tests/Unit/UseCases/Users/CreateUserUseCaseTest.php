<?php

namespace Tests\Unit\UseCases\Users;

use App\Models\User;
use App\UseCases\Users\CreateUserUseCase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CreateUserUseCaseTest extends TestCase
{
    private CreateUserUseCase $useCase;

    public function test_user_created()
    {
        $user = User::factory()->state(['password' => 'password'])->make();
        $this->useCase->execute($user->getAttributes());
        $this->assertDatabaseHas($user->getTable(), [$user->getKeyName() => $user->getKey()]);
    }

    public function test_user_password_hashed()
    {
        $entity = User::factory()->state(['password' => 'password'])->make();
        $createdUser = $this->useCase->execute($entity->getAttributes());
        $this->assertTrue(
            Hash::check(
                $entity->getAttribute('password'),
                $createdUser->getAttribute('password')
            )
        );
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = $this->app->make(CreateUserUseCase::class);
    }
}
