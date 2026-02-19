<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTO\CreateUserDTO;
use App\Entities\UserEntity;
use App\Exceptions\CreateUserException;
use App\Models\User;
use Throwable;

class CreateUserAction implements CreateUserActionInterface
{
    public function execute(CreateUserDTO $dto): UserEntity
    {
        $user = User::query()->create($dto->toArray());

        return UserEntity::fromModel($user);
    }
}
