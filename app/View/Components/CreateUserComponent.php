<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CreateUserComponent extends Component
{
    /**
     * @param array<int, array{id:int, name:string}> $departments
     * @param array<int, array{value:string, label:string}> $roles
     * @param array<int, array{value:string, label:string}> $permissions
     */
    public function __construct(
        public readonly array $departments = [],
        public readonly array $roles = [],
        public readonly array $permissions = [],
        public readonly string $submitUrl = ''
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.create-user-component');
    }
}
