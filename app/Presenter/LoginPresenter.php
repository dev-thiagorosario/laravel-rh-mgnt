<?php

declare(strict_types=1);

namespace App\Presenter;

use App\Entities\UserEntity;

final class LoginPresenter
{
    public function present(UserEntity $auth): array
    {
        $user = $auth->toArray();

        unset($user['password']);

        return [
            'authenticated' => true,
            'user' => $user,
        ];
    }
}
