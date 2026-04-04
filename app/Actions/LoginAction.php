<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTO\LoginInputDTO;
use App\Entities\UserEntity;
use App\Exceptions\InvalidCredentialsException;
use App\Exceptions\UserBlockedException;
use App\Exceptions\UserInactiveException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

final class LoginAction implements LoginActionInterface
{
    public function execute(LoginInputDTO $dto): UserEntity
    {
        $field = filter_var($dto->login, FILTER_VALIDATE_EMAIL) !== false
            ? 'email'
            : 'name';

        $user = User::withTrashed()
            ->where($field, $dto->login)
            ->first();

        if ($user === null || ! Hash::check($dto->password, (string) $user->password)) {
            throw new InvalidCredentialsException();
        }

        if ($user->trashed()) {
            throw new UserInactiveException();
        }

        if ($this->isBlocked($user)) {
            throw new UserBlockedException();
        }

        Auth::login($user);
        session()->regenerate();

        $user->loadMissing(['departament', 'detail']);

        return UserEntity::fromModel($user);
    }

    private function isBlocked(User $user): bool
    {
        return $user->getAttribute('is_blocked') === true
            || $user->getAttribute('status') === 'blocked'
            || $user->getAttribute('blocked_at') !== null;
    }
}
