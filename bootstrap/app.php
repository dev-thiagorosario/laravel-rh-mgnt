<?php

use App\Http\Middleware\PropagateBackendCookies;
use App\Http\Middleware\WithoutCSRF;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(
            prepend: [
                PropagateBackendCookies::class,
            ],
            replace: [
                ValidateCsrfToken::class => WithoutCSRF::class,
            ],
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            static fn ($request): bool => $request->expectsJson()
                || $request->is(WithoutCSRF::PREFIX, WithoutCSRF::PREFIX.'/*')
        );
    })->create();
