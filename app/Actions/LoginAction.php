<?php

declare(strict_types=1);

namespace App\Actions;

use App\Exceptions\LoginException;
use Illuminate\Support\Facades\Auth;

class LoginAction implements LoginActionInterface
{
    public function execute(array $credentials): void
    {
        $login = (string) ($credentials['login'] ?? $credentials['email'] ?? '');
        $password = (string) ($credentials['password'] ?? '');

        if ($login === '' || $password === '') {
            throw new LoginException();
        }

        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if (! Auth::attempt([$field => $login, 'password' => $password])) {
            throw new LoginException();
        }

        session()->regenerate();
    }
}
