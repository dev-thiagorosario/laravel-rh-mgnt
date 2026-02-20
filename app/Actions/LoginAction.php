<?php

declare(strict_types=1);

namespace App\Actions;

use App\Exceptions\LoginException;
use Illuminate\Support\Facades\Auth;

final class LoginAction implements LoginActionInterface
{
    public function execute(array $credentials): void
    {
        $login = trim((string) ($credentials['login'] ?? $credentials['email'] ?? ''));
        $password = (string) ($credentials['password'] ?? '');

        if ($login === '' || $password === '') {
            throw new LoginException('Credenciais inválidas.');
        }

        $field = filter_var($login, FILTER_VALIDATE_EMAIL) !== false
            ? 'email'
            : 'name';

        $authenticated = Auth::attempt([
            $field => $login,
            'password' => $password,
        ]);

        if (! $authenticated) {
            throw new LoginException('Login ou senha incorretos.');
        }

        session()->regenerate();
    }
}