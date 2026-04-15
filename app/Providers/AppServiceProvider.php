<?php

declare(strict_types=1);

namespace App\Providers;

use App\Actions\CreateUserAction;
use App\Actions\CreateUserActionInterface;
use App\Actions\GetAuthenticatedUserViewDataAction;
use App\Actions\GetAuthenticatedUserViewDataActionInterface;
use App\Actions\ListDepartamentAction;
use App\Actions\ListDepartamentActionInterface;
use App\Actions\LoginAction;
use App\Actions\LoginActionInterface;
use App\Actions\LogoutAction;
use App\Actions\LogoutActionInterface;
use App\Actions\ResolveSidebarMenuAction;
use App\Actions\ResolveSidebarMenuActionInterface;
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

        $this->app->bind(
            ListDepartamentActionInterface::class,
            ListDepartamentAction::class
        );

        $this->app->bind(
            GetAuthenticatedUserViewDataActionInterface::class,
            GetAuthenticatedUserViewDataAction::class
        );

        $this->app->bind(
            ResolveSidebarMenuActionInterface::class,
            ResolveSidebarMenuAction::class
        );

        $this->app->bind(
            'App\Actions\CreateDepartmentActionInterface',
            'App\Actions\CreateDepartmentAction'
        );
    }

    public function boot(): void
    {
        Gate::define('admin', static fn (User $user): bool => $user->role === 'admin');
        Gate::define('manager', static fn (User $user): bool => $user->role === 'manager');
        Gate::define('employee', static fn (User $user): bool => $user->role === 'employee');
    }
}
