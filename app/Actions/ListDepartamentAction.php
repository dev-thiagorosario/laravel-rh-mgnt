<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Departament;

final class ListDepartamentAction implements ListDepartamentActionInterface
{
    public function list(): array
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
}
