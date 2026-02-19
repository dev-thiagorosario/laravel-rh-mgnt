<?php

namespace App\Providers;

use App\Actions\CreateUserAction;
use App\Actions\CreateUserActionInterface;
use App\Actions\ShowAdminAction;
use App\Actions\ShowAdminActionInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            ShowAdminActionInterface::class,
            ShowAdminAction::class
        );

        $this->app->bind(
            CreateUserActionInterface::class,
            CreateUserAction::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
