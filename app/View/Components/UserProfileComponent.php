<?php

declare(strict_types=1);

namespace App\View\Components;

use App\View\Models\UserProfileViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class UserProfileComponent extends Component
{
    public readonly string $userName;

    public readonly string $userEmail;

    public readonly string $userRole;

    public readonly string $userDepartment;

    public readonly string $createdAt;

    /**
     * Create a new component instance.
     */
    public function __construct(
        UserProfileViewModel $vm
    ) {
        $this->userName = $vm->userName();
        $this->userEmail = $vm->userEmail();
        $this->userRole = $vm->userRole();
        $this->userDepartment = $vm->userDepartment();
        $this->createdAt = $vm->createdAt();
    }

    public function render(): View
    {
        return view('components.user-profile-component');
    }
}
