<?php

declare(strict_types=1);

namespace App\View\Models;

use App\Models\Departament;
use Illuminate\Database\Eloquent\Model;

class CreateUserViewModel extends Model

{
    public function departments(): array
    {
        return Departament::query()
            ->select(['id', 'name'])
            ->orderBy('name')
            ->get()
            ->map(static fn (Departament $department): array => [
                'id' => $department->id,
                'name' => $department->name,
            ])
            ->all();
    }

    public function roles(): array
    {
        return [
            ['value' => 'admin', 'label' => 'Administrador'],
            ['value' => 'manager', 'label' => 'Gestor'],
            ['value' => 'employee', 'label' => 'Colaborador'],
        ];
    }

    public function permissions(): array
    {
        return [
            ['value' => 'users.read', 'label' => 'Visualizar usuarios'],
            ['value' => 'users.write', 'label' => 'Editar usuarios'],
            ['value' => 'departaments.read', 'label' => 'Visualizar departamentos'],
            ['value' => 'departaments.write', 'label' => 'Editar departamentos'],
            ['value' => 'reports.read', 'label' => 'Visualizar relatorios'],
        ];
    }
}
