<?php

namespace UseCases\Users;

use App\UseCases\User\GetCurrentUserUseCase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class GetCurrentUserUseCaseTest extends TestCase
{
    private GetCurrentUserUseCase $useCase;

    public function test_current_user_is_correct()
    {
        $user = $this->useCase->execute();
        $this->assertNull($user);

        Passport::actingAs($this->user);
        $user = $this->useCase->execute();
        $this->assertNotNull($user);
        $this->assertTrue($this->user->is($user));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->useCase = $this->app->make(GetCurrentUserUseCase::class);
    }
}
