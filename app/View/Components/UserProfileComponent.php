<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class UserProfileComponent extends Component
{
    public readonly string $userName;

    public readonly string $userEmail;

    public readonly string $userRole;

    public readonly string $userDepartment;

    public readonly string $createdAt;

    public function __construct(
        string $userName,
        string $userEmail,
        string $userRole,
        string $userDepartment,
        string $createdAt,
    ) {
        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->userRole = $userRole;
        $this->userDepartment = $userDepartment;
        $this->createdAt = $createdAt;
    }

    public function render(): View
    {
        return view('components.user-profile-component');
    }
}
