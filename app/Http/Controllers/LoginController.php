<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\LoginActionInterface;
use App\Entities\ResponseJsend;
use App\Exceptions\LoginException;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

final class LoginController extends Controller
{
    public function __construct(
        private readonly LoginActionInterface $loginAction,
    ) {}

    public function __invoke(LoginRequest $request): JsonResponse|RedirectResponse
    {
        try {
            $this->loginAction->execute($request->validated());

            if ($this->shouldReturnJson($request)) {
                $user = Auth::user();
                $result = new ResponseJsend([
                    'redirect_to' => route('dashboard'),
                    'user' => $user === null ? null : [
                        'id' => (int) $user->id,
                        'name' => (string) $user->name,
                        'email' => (string) $user->email,
                    ],
                ]);

                return response()->json($result->toArray(), 200);
            }

            return redirect()
                ->intended(route('dashboard'));
        } catch (LoginException $e) {
            if ($this->shouldReturnJson($request)) {
                $result = new ResponseJsend(
                    status: 'fail',
                    message: $e->getMessage(),
                    code: $e->getCode(),
                );

                return response()->json($result->toArray(), 401);
            }

            return back()
                ->withErrors(['login' => $e->getMessage()])
                ->onlyInput('login');
        } catch (Throwable) {
            if ($this->shouldReturnJson($request)) {
                $exception = new LoginException();
                $result = new ResponseJsend(
                    status: 'error',
                    message: $exception->getMessage(),
                    code: $exception->getCode(),
                );

                return response()->json($result->toArray(), 500);
            }

            return back()
                ->withErrors(['login' => 'Ocorreu um erro inesperado ao fazer login.'])
                ->onlyInput('login');
        }
    }

    private function shouldReturnJson(LoginRequest $request): bool
    {
        return $request->expectsJson() || $request->is('bruno/*');
    }
}
