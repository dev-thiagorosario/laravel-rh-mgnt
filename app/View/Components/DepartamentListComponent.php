<?php

declare(strict_types=1);

namespace App\View\Components;

use App\View\Models\DepartamentListViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class DepartamentListComponent extends Component
{
    public function __construct(
        public readonly DepartamentListViewModel $vm,
    ) {
    }

    public function render(): View
    {
        return view('components.departament-list-component');
    }
}
