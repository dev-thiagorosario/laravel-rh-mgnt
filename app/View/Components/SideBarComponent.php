<?php

declare (strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\View\Models\SideBarViewModel;

class SideBarComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        private readonly SideBarViewModel $vm,
    ){}


    public function menuItems(): array
    {
        return match ($this->vm->roleUser()) {
            'admin' => $this->vm->adminMenuItems(),
            'manager' => $this->vm->managerMenuItems(),
            default => $this->vm->employeeMenuItems(),
        };
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.side-bar-component', [
            'menuItems' => $this->menuItems(),
        ]);
    }
}
