<?php

declare(strict_types=1);

namespace App\View\Http\Controller;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\View\Http\BackendApiClient;
use Illuminate\Http\RedirectResponse;
use Throwable;

final class WebLoginController extends Controller
{
    public function __construct(
        private readonly BackendApiClient $backendApiClient,
    ) {}

    public function __invoke(LoginRequest $request): RedirectResponse
    {
        try {
            $response = $this->backendApiClient->post(
                request: $request,
                routeName: 'bruno.login.authenticate',
                payload: $request->validated(),
                asForm: true,
            );

            if (! $response->successful()) {
                return back()
                    ->withErrors([
                        'login' => $this->backendApiClient->errorMessage(
                            $response,
                            'Nao foi possivel autenticar o usuario.',
                        ),
                    ])
                    ->onlyInput('email');
            }

            $redirectResponse = redirect()->intended(route('dashboard'));

            $this->backendApiClient->storeResponseCookies($redirectResponse, $response);

            return $redirectResponse;
        } catch (Throwable) {
            return back()
                ->withErrors(['login' => 'Ocorreu um erro inesperado ao fazer login.'])
                ->onlyInput('email');
        }
    }
}
