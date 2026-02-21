<?php

declare(strict_types=1);

namespace App\View\Components;

use App\View\Models\UserBarViewModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserBarComponent extends Component
{
    public string $name;
    public string $department;

    /**
     * Create a new component instance.
     */
    public function __construct(
        UserBarViewModel $vm,
    ) {
        $this->name = $vm->name();
        $this->department = $vm->department();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-bar-component');
    }
}
