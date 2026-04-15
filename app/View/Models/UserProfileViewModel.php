<?php

declare(strict_types=1);

namespace App\View\Models;

final class UserProfileViewModel
{
    public function __construct(
        private readonly string $userName,
        private readonly string $userRole,
        private readonly string $userEmail,
        private readonly string $userDepartment,
        private readonly string $createdAt,
    ) {
    }

    public function userName(): string
    {
        return $this->userName;
    }

    public function userRole(): string
    {
        return $this->userRole;
    }

    public function userEmail(): string
    {
        return $this->userEmail;
    }

    public function userDepartment(): string
    {
        return $this->userDepartment;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }
}
