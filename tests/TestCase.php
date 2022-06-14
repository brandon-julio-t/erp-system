<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Mockery\MockInterface;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions, WithFaker;

    protected User $user;

    protected function mockUseCase(MockInterface $mock, mixed $returnData)
    {
        $mock->shouldReceive('execute')
            ->once()
            ->andReturn($returnData);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }
}
