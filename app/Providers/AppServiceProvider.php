<?php

declare(strict_types=1);

namespace App\Providers;

use App\Actions\CreateUserAction;
use App\Actions\CreateUserActionInterface;
use App\Actions\LoginAction;
use App\Actions\LoginActionInterface;
use App\Actions\LogoutAction;
use App\Actions\LogoutActionInterface;
use App\Actions\ResetPasswordAction;
use App\Actions\ResetPasswordActionInterface;
use App\Actions\UpdateUserAction;
use App\Actions\UpdateUserActionInterface;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
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

        $this->app->bind(
            UpdateUserActionInterface::class,
            UpdateUserAction::class
        );
    }

    public function boot(): void
    {
        Gate::define('admin', static fn (User $user): bool => $user->role === 'admin');
        Gate::define('manager', static fn (User $user): bool => $user->role === 'manager');
        Gate::define('employee', static fn (User $user): bool => $user->role === 'employee');
    }
}
