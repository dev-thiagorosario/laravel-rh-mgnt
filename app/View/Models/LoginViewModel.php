<?php

declare(strict_types=1);

namespace App\View\Models;

final class LoginViewModel
{
    public function __construct(
        private readonly string $submitUrl,
    ) {
    }

    public function submitUrl(): string
    {
        return $this->submitUrl;
    }
}
