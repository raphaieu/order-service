<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\UserRepository;

use App\Infrastructure\Persistence\EloquentUserRepository;
use App\Application\Services\AuthService;

use App\Domain\Repositories\OrderRepository;
use App\Infrastructure\Persistence\EloquentOrderRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
        $this->app->bind(AuthService::class, function ($app) {
            return new AuthService($app->make(UserRepository::class));
        });
        $this->app->bind(OrderRepository::class, EloquentOrderRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
