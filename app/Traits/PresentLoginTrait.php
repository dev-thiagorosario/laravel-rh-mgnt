<?php

declare(strict_types=1);

namespace App\Traits;

use App\Entities\UserEntity;

trait PresentLoginTrait
{
    public function initializePresentLoginTrait(UserEntity $auth): array
    {
        $user = $auth->toArray();

        unset($user['password']);

        return [
            'authenticated' => true,
            'user' => $user,
        ];
    }
}
