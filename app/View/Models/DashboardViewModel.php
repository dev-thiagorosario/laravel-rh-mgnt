<?php

declare(strict_types=1);

namespace App\View\Models;

final class DashboardViewModel
{
    public function __construct(
        private readonly string $profileUrl,
        private readonly bool $canCreateUser,
        private readonly ?string $createUserUrl,
    ) {
    }

    public function profileUrl(): string
    {
        return $this->profileUrl;
    }

    public function canCreateUser(): bool
    {
        return $this->canCreateUser;
    }

    public function createUserUrl(): ?string
    {
        return $this->createUserUrl;
    }
}
