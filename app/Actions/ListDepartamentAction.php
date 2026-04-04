<?php

declare(strict_types=1);

namespace App\Actions;

use App\Entities\DepartamentEntity;
use App\Models\Departament;

class ListDepartamentAction implements ListDepartamentActionInterface
{
    /**
     * @return array{
     *     departaments: list<array<string, mixed>>
     * }
     */
    public function list(): array
    {
        $departaments = Departament::query()
            ->orderBy('name')
            ->get()
            ->map(
                static fn (Departament $departament): array 
                => DepartamentEntity::fromModel($departament)->toArray()
            )
            ->values()
            ->all();

        return [
            'departaments' => $departaments,
        ];
    }
}
