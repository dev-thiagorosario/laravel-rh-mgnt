<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\LoginViewException;
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
