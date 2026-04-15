<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Actions\ResolveSidebarMenuActionInterface;
use App\View\Models\SideBarViewModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class SideBarComponent extends Component
{
    private SideBarViewModel $vm;

    public function __construct(
        ResolveSidebarMenuActionInterface $resolveSidebarMenuAction,
    ) {
        $this->vm = new SideBarViewModel(
            menuItems: $resolveSidebarMenuAction->execute(),
        );
    }

    public function menuItems(): array
    {
        return $this->vm->menuItems();
    }

    public function render(): View|Closure|string
    {
        return view('components.side-bar-component', [
            'menuItems' => $this->menuItems(),
        ]);
    }
}
