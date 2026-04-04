<?php

declare(strict_types=1);

namespace App\Actions;

use App\Exceptions\LogoutException;
use Illuminate\Support\Facades\Auth;
use Throwable;

class LogoutAction implements LogoutActionInterface
{
    public function execute(): void
    {
        $user = Auth::user();

        if ($user === null) {
            throw new LogoutException('Usuario nao autenticado.');
        }

        try {
            if (method_exists($user, 'currentAccessToken') && $user->currentAccessToken() !== null) {
                $user->currentAccessToken()->delete();
            }

            Auth::logout();
        } catch (Throwable $e) {
            throw new LogoutException(previous: $e);
        }
    }
}
