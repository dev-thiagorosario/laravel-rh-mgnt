<?php

declare(strict_types=1);

namespace App\View\Http\Controller;

use App\Http\Controllers\Controller;
use App\View\Models\LoginViewModel;
use Illuminate\Contracts\View\View;

final class LoginViewController extends Controller
{
    public function __invoke(): View
    {
        $viewModel = new LoginViewModel(
            submitUrl: route('login.authenticate'),
        );

        return view('auth.login', [
            'viewModel' => $viewModel,
        ]);
    }
}
