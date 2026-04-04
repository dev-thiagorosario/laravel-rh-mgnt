<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTO\LoginInputDTO;
use App\Entities\UserEntity;

interface LoginActionInterface
{
    public function execute(LoginInputDTO $dto): UserEntity;
}
