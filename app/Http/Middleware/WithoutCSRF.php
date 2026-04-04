<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;

class WithoutCSRF extends ValidateCsrfToken
{
    public const PREFIX = 'bruno';

    /**
     * @var array<int, string>
     */
    protected $except = [
        self::PREFIX.'/*',
    ];
}
