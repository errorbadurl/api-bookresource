<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

         Gate::define('auth-check', function ($user, $book) {
            if ($user && $book) {
                return $user->id == $book->user_id;
            }
        });

        Passport::routes();

        Passport::tokensExpireIn(now()->addDays(1));

        Passport::refreshTokensExpireIn(now()->addDays(1));
    }
}
