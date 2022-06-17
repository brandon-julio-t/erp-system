<?php

namespace Http\Controllers;

use App\Models\User;
use App\UseCases\User\CreateUserUseCase;
use App\UseCases\User\DeleteUserUseCase;
use App\UseCases\User\GetAllUsersUseCase;
use App\UseCases\User\GetCurrentUserUseCase;
use App\UseCases\User\GetOneUserByIdUseCase;
use App\UseCases\User\UpdateUserUseCase;
use Laravel\Passport\Passport;
use Mockery\MockInterface;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_me_function_is_correct()
    {
        $this->mock(
            GetCurrentUserUseCase::class,
            fn(MockInterface $mock) => $this->mockUseCase($mock, $this->user),
        );

        $route = route('users.me');

        $this->getJson($route)->assertUnauthorized();

        Passport::actingAs($this->user, ['']);
        $this->getJson($route)->assertForbidden();

        Passport::actingAs($this->user, ['read-user']);
        $this->getJson($route)->assertOk();
    }

    public function test_index_function_is_correct()
    {
        $this->mock(
            GetAllUsersUseCase::class,
            fn(MockInterface $mock) => $this->mockUseCase($mock, User::query()->paginate()),
        );

        $route = route('users.index');

        $this->getJson($route)->assertUnauthorized();

        Passport::actingAs($this->user, ['']);
        $this->getJson($route)->assertForbidden();

        Passport::actingAs($this->user, ['read-user']);
        $this->getJson($route)->assertOk();
    }

    public function test_store_function_is_correct()
    {
        $this->mock(
            CreateUserUseCase::class,
            fn(MockInterface $mock) => $this->mockUseCase($mock, $this->user),
        );

        $route = route('users.store');
        $payload = [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => $this->faker->password(8),
        ];

        $this->postJson($route, $payload)->assertUnauthorized();

        Passport::actingAs($this->user, ['']);
        $this->postJson($route, $payload)->assertForbidden();

        Passport::actingAs($this->user, ['create-user']);
        $this->postJson($route, $payload)->assertOk();
    }

    public function test_show_function_is_correct()
    {
        $this->mock(
            GetOneUserByIdUseCase::class,
            fn(MockInterface $mock) => $this->mockUseCase($mock, $this->user),
        );

        $route = route('users.show', $this->user);

        $this->getJson($route)->assertUnauthorized();

        Passport::actingAs($this->user, ['']);
        $this->getJson($route)->assertForbidden();

        Passport::actingAs($this->user, ['read-user']);
        $this->getJson($route)->assertOk();
    }

    public function test_update_function_is_correct()
    {
        $this->mock(
            UpdateUserUseCase::class,
            fn(MockInterface $mock) => $this->mockUseCase($mock, $this->user),
        );

        $route = route('users.update', $this->user);
        $payload = [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => $this->faker->password(8),
        ];

        $this->putJson($route, $payload)->assertUnauthorized();

        Passport::actingAs($this->user, ['']);
        $this->putJson($route, $payload)->assertForbidden();

        Passport::actingAs($this->user, ['update-user']);
        $this->putJson($route, $payload)->assertOk();
    }

    public function test_destroy_function_is_correct()
    {
        $this->mock(
            DeleteUserUseCase::class,
            fn(MockInterface $mock) => $this->mockUseCase($mock, $this->user),
        );

        $route = route('users.destroy', $this->user);

        $this->deleteJson($route)->assertUnauthorized();

        Passport::actingAs($this->user, ['']);
        $this->deleteJson($route)->assertForbidden();

        Passport::actingAs($this->user, ['delete-user']);
        $this->deleteJson($route)->assertOk();
    }
}
