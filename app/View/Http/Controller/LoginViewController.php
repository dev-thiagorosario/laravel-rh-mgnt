<?php

declare(strict_types=1);

namespace App\View\Http\Controller;

use App\Http\Controllers\Controller;
use App\View\Exceptions\LoginViewException;
use Illuminate\Contracts\View\View;
use Throwable;

class LoginViewController extends Controller
{
    public function __invoke(): View
    {
        try {

            return view('auth.login');

        } catch (LoginViewException $e) {

            abort(
                $e->getCode(),
                $e->getMessage()
            );

        } catch (Throwable $e) {

            abort(
            500, 
            'An unexpected error occurred.',
            $e->getMessage()
            );

        }
    }
}
