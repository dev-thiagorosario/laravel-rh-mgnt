<?php

declare(strict_types=1);

namespace App\Presenter;

use App\Entities\UserEntity;

final class ResetPasswordPresenter
{
    public function present(UserEntity $user): array
    {
        return [
            'user' => [
                'id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
            ],
        ];
    }

    public function successMessage(): string
    {
        return 'Senha resetada com sucesso.';
    }
}
