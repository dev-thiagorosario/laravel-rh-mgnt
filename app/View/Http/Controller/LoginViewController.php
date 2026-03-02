<?php

declare(strict_types=1);

namespace App\View\Http\Controller;

use App\Exceptions\LoginViewException;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Throwable;

class LoginViewController extends Controller
{
    public function __invoke(): View
    {
        try {

            return view('auth.login');

        } catch (Throwable $e) {

            throw new LoginViewException(previous: $e);

        }
    }
}
