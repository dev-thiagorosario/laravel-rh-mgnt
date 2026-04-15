<?php

declare(strict_types=1);

namespace App\Presenter;

use App\Entities\UserEntity;

final class UserPresenter
{
    public function present(UserEntity $user): array
    {
        $data = $user->toArray();

        unset($data['password']);

        return $data;
    }
}
