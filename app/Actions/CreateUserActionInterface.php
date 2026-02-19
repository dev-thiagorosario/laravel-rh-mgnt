<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTO\CreateUserDTO;
use App\Entities\UserEntity;

interface CreateUserActionInterface
{
    public function execute(CreateUserDTO $dto): UserEntity;
}
