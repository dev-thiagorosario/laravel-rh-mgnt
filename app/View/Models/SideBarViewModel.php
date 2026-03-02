<?php

declare (strict_types=1);

namespace App\View\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class SideBarViewModel extends Model
{
    public function roleUser(): string
    {
        $user = auth()->user();
        return $user ? $user->getRoleUser() : '';
    }

    public function adminMenuItems(): array
    {
        return [
            [
                'title' => 'Home',
                'route' => $this->routeOrHash('dashboard'),
                'icon' => 'fas fa-home me-3',
            ],
            [
                'title' => 'Todos Colaboradores',
                'route' => $this->routeOrHash('employees.index'),
                'icon' => 'fas fa-users me-3',
            ],
            [
                'title' => 'Departamentos',
                'route' => $this->routeOrHash('departments.index'),
                'icon' => 'fas fa-building me-3',
            ],
            [
                'title' => 'Adicionar Colaborador',
                'route' => $this->routeOrHash('users.create'),
                'icon' => 'fas fa-user-plus me-3',
            ],
            [
                'title' => 'Colaboradores do Departamento',
                'route' => $this->routeOrHash('departments.employees'),
                'icon' => 'fas fa-users-cog me-3',
            ]
        ];
    }

    public function managerMenuItems(): array
    {
        return [
            [
                'title' => 'Home',
                'route' => $this->routeOrHash('dashboard'),
                'icon' => 'fas fa-home me-3',
            ],
            [
                'title' => 'Colaboradores do Departamento',
                'route' => $this->routeOrHash('departments.employees'),
                'icon' => 'fas fa-users-cog me-3',
            ],
            [
                'title' => 'Adicionar Colaborador',
                'route' => $this->routeOrHash('users.create'),
                'icon' => 'fas fa-user-plus me-3',
            ]
        ];
    }

    public function employeeMenuItems(): array
    {
        return [
            [
                'title' => 'Home',
                'route' => $this->routeOrHash('dashboard'),
                'icon' => 'fas fa-home me-3',
            ],
            [
                'title' => 'Meu Perfil',
                'route' => $this->routeOrHash('profile.show'),
                'icon' => 'fas fa-user me-3',
            ]
        ];
    }

    private function routeOrHash(string $routeName): string
    {
        return Route::has($routeName) ? route($routeName) : '#';
    }
}
