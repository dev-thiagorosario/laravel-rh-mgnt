<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class CreateUserComponent extends Component
{
    public function __construct(
        public readonly array $departments,
        public readonly array $roles,
        public readonly array $permissions,
        public readonly string $submitUrl,
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.create-user-component');
    }
}
