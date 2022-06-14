<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if (! $this->app->routesAreCached()) {
            Passport::routes();
        }

        Passport::tokensCan([
            'create-user' => 'Create user',
            'read-user' => 'Read user',
            'update-user' => 'Update user',
            'delete-user' => 'Delete user',

            'create-transaction' => 'Create transaction',
            'read-transaction' => 'Read transaction',
            'update-transaction' => 'Update transaction',
            'delete-transaction' => 'Delete transaction',

            'create-product' => 'Create product',
            'read-product' => 'Read product',
            'update-product' => 'Update product',
            'delete-product' => 'Delete product',
        ]);
    }
}
