<?php

declare(strict_types=1);

namespace App\View\Models;

final class SideBarViewModel
{
    public function __construct(
        private readonly array $menuItems,
    ) {
    }

    public function menuItems(): array
    {
        return $this->menuItems;
    }
}
