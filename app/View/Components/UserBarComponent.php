<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Actions\GetAuthenticatedUserViewDataActionInterface;
use App\View\Models\UserBarViewModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class UserBarComponent extends Component
{
    public string $name;
    public string $department;

    public function __construct(
        GetAuthenticatedUserViewDataActionInterface $getAuthenticatedUserViewDataAction,
    ) {
        $userData = $getAuthenticatedUserViewDataAction->execute();
        $vm = new UserBarViewModel(
            name: $userData['name'],
            department: $userData['department'],
        );

        $this->name = $vm->name();
        $this->department = $vm->department();
    }

    public function render(): View|Closure|string
    {
        return view('components.user-bar-component');
    }
}
