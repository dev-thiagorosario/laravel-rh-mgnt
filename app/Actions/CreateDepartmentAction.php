<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTO\CreateDepartmentDTO;
use App\Entities\DepartamentEntity;
use App\Models\Departament;
use Illuminate\Support\Facades\Auth;

final class CreateDepartmentAction implements CreateDepartmentActionInterface
{
    public function create(CreateDepartmentDTO $dto): DepartamentEntity
    {
        $departamentData = $dto->toArray();
        $departamentData['created_by'] = Auth::id();

        $departament = Departament::query()->create($departamentData);

        return DepartamentEntity::fromModel($departament);
    }
}
