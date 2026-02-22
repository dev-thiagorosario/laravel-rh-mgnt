<?php

declare(strict_types=1);

namespace App\Actions;

use App\Entities\UserEntity;

interface ResetPasswordActionInterface
{
    public function execute(int $userId): UserEntity;
}
