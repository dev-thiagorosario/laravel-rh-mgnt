<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class UpdateUserComponent extends Component
{
    public readonly bool $canSubmit;

    public function __construct(
        public readonly string $userName,
        public readonly string $userEmail,
        public readonly string $userRole = '',
        public readonly string $userDepartment = '',
        public readonly string $createdAt = '',
        public readonly string $modalId = 'updateUserModal',
        public readonly string $submitUrl = '#',
    ) {
        $this->canSubmit = $this->submitUrl !== '#';
    }

    public function render(): View
    {
        return view('components.update-user-component');
    }
}
