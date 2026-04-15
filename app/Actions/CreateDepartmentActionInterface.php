<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTO\CreateDepartmentDTO;
use App\Entities\DepartamentEntity;

interface CreateDepartmentActionInterface
{
    public function create(CreateDepartmentDTO $dto): DepartamentEntity;
}
