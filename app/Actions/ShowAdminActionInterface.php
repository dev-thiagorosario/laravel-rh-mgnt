<?php

declare(strict_types=1);

namespace App\Actions;

use App\Entities\UserEntity;

interface ShowAdminActionInterface
{
    public function execute(): UserEntity;
}
