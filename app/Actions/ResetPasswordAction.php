<?php

declare(strict_types=1);

namespace App\Actions;

use App\Entities\UserEntity;
use App\Exceptions\ResetPasswordException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordAction implements ResetPasswordActionInterface
{
    private const DEFAULT_PASSWORD = 'rhmgnt123';

    public function execute(int $userId): UserEntity
    {
        $user = User::query()->find($userId);

        if ($user === null) {
            throw new ResetPasswordException('Usuario nao encontrado.');
        }

        $newPassword = self::DEFAULT_PASSWORD;
        $user->password = Hash::make($newPassword);
        $user->save();

        return (new UserEntity())
            ->setId((int) $user->id)
            ->setName((string) $user->name)
            ->setEmail((string) $user->email)
            ->setPassword($newPassword);
    }
}
