<?php

declare(strict_types=1);

namespace App\Traits;

use App\Entities\UserEntity;

trait PresentUserTrait
{
    protected function presentUser(UserEntity $user): array
    {
        $data = $user->toArray();

        unset($data['password']);

        return $data;
    }
}
