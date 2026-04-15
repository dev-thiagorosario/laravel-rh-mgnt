<?php

declare(strict_types=1);

namespace App\View\Models;

final class UserBarViewModel
{
    public function __construct(
        private readonly string $name,
        private readonly string $department,
    ) {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function department(): string
    {
        return $this->department;
    }
}
