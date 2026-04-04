<?php

declare(strict_types=1);

namespace App\Traits;

use App\Entities\UserEntity;

trait PresentResetPasswordTrait
{
    protected function initializePresentResetPasswordTrait(UserEntity $user): array
    {
        return [
            'user' => [
                'id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
            ],
        ];
    }

    protected function resetPasswordSuccessMessage(): string
    {
        return 'Senha resetada com sucesso.';
    }
}
