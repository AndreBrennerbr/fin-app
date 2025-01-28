<?php

namespace App\Providers;

use App\Repositories\Interfaces\TransactionInterfaceRepository;
use App\Repositories\Interfaces\UserInterfaceRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserInterfaceRepository::class, UserRepository::class);
        $this->app->bind(TransactionInterfaceRepository::class, TransactionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
