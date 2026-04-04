<?php

declare(strict_types=1);

namespace App\View\Http\Controller;

use App\Actions\LoginActionInterface;
use App\DTO\LoginInputDTO;
use App\Exceptions\InvalidCredentialsException;
use App\Exceptions\UserBlockedException;
use App\Exceptions\UserInactiveException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Throwable;

final class WebLoginController extends Controller
{
    public function __construct(
        private readonly LoginActionInterface $loginAction,
    ) {}

    public function __invoke(LoginRequest $request): RedirectResponse
    {
        try {
            $this->loginAction->execute(
                LoginInputDTO::fromArray($request->validated())
            );

            return redirect()
                ->intended(route('dashboard'));
        } catch (InvalidCredentialsException|UserInactiveException|UserBlockedException $e) {
            return back()
                ->withErrors(['login' => $e->getMessage()])
                ->onlyInput('login');
        } catch (Throwable) {
            return back()
                ->withErrors(['login' => 'Ocorreu um erro inesperado ao fazer login.'])
                ->onlyInput('login');
        }
    }
}
