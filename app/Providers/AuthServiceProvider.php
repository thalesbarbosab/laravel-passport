<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //laravel passport routes
        Passport::routes();

        //access_tokens expires in 60 minutos
        Passport::tokensExpireIn(now()->addMinutes(60));

        //laravel passport refresh token expiration
        Passport::refreshTokensExpireIn(now()->addDays(30));

    }
}
