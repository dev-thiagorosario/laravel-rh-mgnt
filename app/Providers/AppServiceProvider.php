<?php

namespace App\Providers;

use App\Actions\CreateUserAction;
use App\Actions\CreateUserActionInterface;
use App\Actions\LoginAction;
use App\Actions\LoginActionInterface;
use App\Actions\LogoutAction;
use App\Actions\LogoutActionInterface;
use App\Actions\ResetPasswordAction;
use App\Actions\ResetPasswordActionInterface;
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

        $this->app->bind(
            LoginActionInterface::class,
            LoginAction::class
        );

        $this->app->bind(
            LogoutActionInterface::class,
            LogoutAction::class
        );

        $this->app->bind(
            ResetPasswordActionInterface::class,
            ResetPasswordAction::class
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
