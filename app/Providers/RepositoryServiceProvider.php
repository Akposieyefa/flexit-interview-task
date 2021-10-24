<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //auth repository binding
        $this->app->bind(
            \App\Repositories\Contracts\AuthRepositoryInterface::class,
            \App\Repositories\AuthRepository::class
        );
        //email verification repository binding
        $this->app->bind(
            \App\Repositories\Contracts\EmailVerificationRepositoryInterface::class,
            \App\Repositories\EmailVerificationRepository::class
        );
        //twitte repository binding
        $this->app->bind(
            \App\Repositories\Contracts\TwitteRepositoryInterface::class,
            \App\Repositories\TwitteRepository::class
        );
        //user repository binding
        $this->app->bind(
            \App\Repositories\Contracts\UserRepositoryInterface::class,
            \App\Repositories\UserRepository::class
        );

    }
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
