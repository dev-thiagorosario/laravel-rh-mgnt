<?php

declare(strict_types=1);

namespace App\View\Components;

use App\View\Models\CreateUserViewModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CreateUserComponent extends Component
{
    public array $departments;
    public array $roles;
    public array $permissions;
    public string $submitUrl;

    public function __construct(CreateUserViewModel $vm)
    {
        $this->departments = $vm->departments();
        $this->roles = $vm->roles();
        $this->permissions = $vm->permissions();
        $this->submitUrl = route('users.store');
    }

    public function render(): View|Closure|string
    {
        return view('components.create-user-component');
    }
}
