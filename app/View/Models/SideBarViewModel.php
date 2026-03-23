<?php

declare(strict_types=1);

namespace App\View\Models;

use App\Models\User;
use Illuminate\Support\Facades\Route;

final class SideBarViewModel
{
    public function roleUser(): string
    {
        $user = auth()->user();

        return $user instanceof User ? (string) $user->role : '';
    }

    public function adminMenuItems(): array
    {
        return $this->availableMenuItems([
            ['title' => 'Home', 'route' => 'dashboard', 'icon' => 'fas fa-home me-3'],
            ['title' => 'Todos Colaboradores', 'route' => 'employees.index', 'icon' => 'fas fa-users me-3'],
            ['title' => 'Departamentos', 'route' => 'departments.index', 'icon' => 'fas fa-building me-3'],
            ['title' => 'Adicionar Colaborador', 'route' => 'users.create', 'icon' => 'fas fa-user-plus me-3'],
            ['title' => 'Colaboradores do Departamento', 'route' => 'departments.employees', 'icon' => 'fas fa-users-cog me-3'],
            ['title' => 'Perfil do Usuário', 'route' => 'user.profile', 'icon' => 'fas fa-user me-3'],
        ]);
    }

    public function managerMenuItems(): array
    {
        return $this->availableMenuItems([
            ['title' => 'Home', 'route' => 'dashboard', 'icon' => 'fas fa-home me-3'],
            ['title' => 'Colaboradores do Departamento', 'route' => 'departments.employees', 'icon' => 'fas fa-users-cog me-3'],
            ['title' => 'Adicionar Colaborador', 'route' => 'users.create', 'icon' => 'fas fa-user-plus me-3'],
            ['title' => 'Perfil do Usuário', 'route' => 'user.profile', 'icon' => 'fas fa-user me-3'],
        ]);
    }

    public function employeeMenuItems(): array
    {
        return $this->availableMenuItems([
            ['title' => 'Home', 'route' => 'dashboard', 'icon' => 'fas fa-home me-3'],
            ['title' => 'Perfil do Usuário', 'route' => 'user.profile', 'icon' => 'fas fa-user me-3'],
        ]);
    }

    private function availableMenuItems(array $items): array
    {
        return array_values(array_filter(array_map(
            fn (array $item): ?array => $this->menuItem($item['title'], $item['route'], $item['icon']),
            $items
        )));
    }

    private function menuItem(string $title, string $routeName, string $icon): ?array
    {
        if (! Route::has($routeName)) {
            return null;
        }

        return [
            'title' => $title,
            'route' => route($routeName),
            'icon' => $icon,
        ];
    }
}
