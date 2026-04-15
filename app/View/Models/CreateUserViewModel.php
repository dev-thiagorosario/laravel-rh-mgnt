<?php

declare(strict_types=1);

namespace App\View\Models;

final class CreateUserViewModel
{
    public function __construct(
        private readonly array $departments,
        private readonly array $roles,
        private readonly array $permissions,
    ) {
    }

    public function departments(): array
    {
        return $this->departments;
    }

    public function roles(): array
    {
        return $this->roles;
    }

    public function permissions(): array
    {
        return $this->permissions;
    }
}
