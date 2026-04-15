<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\UserRoleEnum;
use Illuminate\Support\Facades\Route;

final class ResolveSidebarMenuAction implements ResolveSidebarMenuActionInterface
{
    public function execute(): array
    {
        return match (auth()->user()?->role) {
            UserRoleEnum::ADMIN->value => $this->availableMenuItems([
                ['title' => 'Home', 'route' => 'dashboard', 'icon' => 'fas fa-home me-3'],
                ['title' => 'Todos Colaboradores', 'route' => 'employees.index', 'icon' => 'fas fa-users me-3'],
                ['title' => 'Departamentos', 'route' => 'departments.index', 'icon' => 'fas fa-building me-3'],
                ['title' => 'Adicionar Colaborador', 'route' => 'users.create', 'icon' => 'fas fa-user-plus me-3'],
                ['title' => 'Colaboradores do Departamento', 'route' => 'departments.employees', 'icon' => 'fas fa-users-cog me-3'],
                ['title' => 'Perfil do Usuário', 'route' => 'user.profile', 'icon' => 'fas fa-user me-3'],
            ]),
            UserRoleEnum::MANAGER->value => $this->availableMenuItems([
                ['title' => 'Home', 'route' => 'dashboard', 'icon' => 'fas fa-home me-3'],
                ['title' => 'Colaboradores do Departamento', 'route' => 'departments.employees', 'icon' => 'fas fa-users-cog me-3'],
                ['title' => 'Adicionar Colaborador', 'route' => 'users.create', 'icon' => 'fas fa-user-plus me-3'],
                ['title' => 'Perfil do Usuário', 'route' => 'user.profile', 'icon' => 'fas fa-user me-3'],
            ]),
            default => $this->availableMenuItems([
                ['title' => 'Home', 'route' => 'dashboard', 'icon' => 'fas fa-home me-3'],
                ['title' => 'Perfil do Usuário', 'route' => 'user.profile', 'icon' => 'fas fa-user me-3'],
            ]),
        };
    }

    private function availableMenuItems(array $items): array
    {
        return array_values(array_map(
            fn (array $item): array => $this->menuItem($item['title'], $item['route'], $item['icon']),
            $items
        ));
    }

    private function menuItem(string $title, string $routeName, string $icon): array
    {
        $isAvailable = Route::has($routeName);

        return [
            'title' => $title,
            'route' => $isAvailable ? route($routeName) : '#',
            'icon' => $icon,
            'is_available' => $isAvailable,
        ];
    }
}
