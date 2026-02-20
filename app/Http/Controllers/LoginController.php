<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\LoginActionInterface;
use App\Exceptions\LoginException;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Throwable;

class LoginController extends Controller
{
    public function __construct(
        private readonly LoginActionInterface $loginAction,
    ) {}

    public function __invoke(LoginRequest $request): RedirectResponse
    {
        try {
            $this->loginAction->execute($request->validated());

            return redirect()->intended(route('dashboard'));
        } catch (LoginException $e) {
            return back()
                ->withErrors(['email' => $e->getMessage()])
                ->onlyInput('email');
        } catch (Throwable $e) {
            return back()
                ->withErrors(['email' => 'Ocorreu um erro inesperado ao fazer login.'])
                ->onlyInput('email');
        }
    }
}
