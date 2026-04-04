<?php

declare(strict_types=1);

namespace App\Actions;

use App\Exceptions\UpdateUserException;
use App\Exceptions\UserNotFoundException;
use App\Models\User;
use Throwable;

class UpdateUserAction implements UpdateUserActionInterface
{
    public function update(int $userId, array $data): void
    {
        $user = User::query()->find($userId);

        if ($user === null) {
            throw new UserNotFoundException();
        }

            $user->update($data);
    }
}
