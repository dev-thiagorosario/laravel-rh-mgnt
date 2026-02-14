<?php

namespace App\Providers;

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
        ShowAdminAction::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
