<?php

declare(strict_types=1);

namespace App\View\Http\Controller;

use App\Http\Controllers\Controller;
use App\View\Models\DepartamentListViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Throwable;

final class WebDepartamentController extends Controller
{
    public function __construct(
        private readonly Router $router,
    ) {
    }

    public function __invoke(Request $request): View
    {
        return view('departament.departaments', [
            'departamentListVm' => $this->departamentListViewModel($request),
        ]);
    }

    private function departamentListViewModel(Request $request): DepartamentListViewModel
    {
        try {
            $response = $this->router->dispatch(
                $this->departamentListRequest($request)
            );

            if (! $response instanceof JsonResponse) {
                return new DepartamentListViewModel(
                    errorMessage: 'Resposta invalida ao listar departamentos.'
                );
            }

            $payload = $response->getData(true);

            if ($response->getStatusCode() !== 200) {
                return new DepartamentListViewModel(
                    errorMessage: is_string($payload['message'] ?? null)
                        ? $payload['message']
                        : 'Nao foi possivel carregar os departamentos.'
                );
            }

            return new DepartamentListViewModel(
                departaments: is_array($payload['data']['departaments'] ?? null)
                    ? $payload['data']['departaments']
                    : [],
                errorMessage: is_array($payload['data']['departaments'] ?? null)
                    ? null
                    : 'Resposta invalida ao listar departamentos.',
            );
        } catch (Throwable) {
            return new DepartamentListViewModel(
                errorMessage: 'Nao foi possivel carregar os departamentos.'
            );
        }
    }

    private function departamentListRequest(Request $request): Request
    {
        $apiRequest = Request::create(
            uri: route('departaments.list', absolute: false),
            method: 'GET',
            cookies: $request->cookies->all(),
            server: array_merge($request->server->all(), [
                'HTTP_ACCEPT' => 'application/json',
                'HTTP_X_REQUESTED_WITH' => 'XMLHttpRequest',
            ]),
        );

        if ($request->hasSession()) {
            $apiRequest->setLaravelSession($request->session());
        }

        $apiRequest->setUserResolver($request->getUserResolver());

        return $apiRequest;
    }
}
