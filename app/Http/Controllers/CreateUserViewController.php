<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Departament;
use Illuminate\Contracts\View\View;

class CreateUserViewController extends Controller
{
    public function __invoke(): View
    {
        $departments = Departament::query()
            ->select(['id', 'name'])
            ->orderBy('name')
            ->get()
            ->map(static fn (Departament $department): array => [
                'id' => $department->id,
                'name' => $department->name,
            ])
            ->all();

        $roles = [
            ['value' => 'admin', 'label' => 'Administrador'],
            ['value' => 'manager', 'label' => 'Gestor'],
            ['value' => 'employee', 'label' => 'Colaborador'],
        ];

        $permissions = [
            ['value' => 'users.read', 'label' => 'Visualizar usuarios'],
            ['value' => 'users.write', 'label' => 'Editar usuarios'],
            ['value' => 'departaments.read', 'label' => 'Visualizar departamentos'],
            ['value' => 'departaments.write', 'label' => 'Editar departamentos'],
            ['value' => 'reports.read', 'label' => 'Visualizar relatorios'],
        ];

        return view('users.create', [
            'departments' => $departments,
            'roles' => $roles,
            'permissions' => $permissions,
            'submitUrl' => route('users.store'),
        ]);
    }
}
