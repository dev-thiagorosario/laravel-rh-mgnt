<?php

declare(strict_types=1);

namespace App\View\Http\Controller;

use App\Http\Controllers\Controller;
use App\View\Http\BackendApiClient;
use App\View\Models\DepartamentListViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Throwable;

final class WebDepartamentController extends Controller
{
    public function __construct(
        private readonly BackendApiClient $backendApiClient,
    ) {
    }

    public function __invoke(Request $request): View
    {
        $viewModel = $this->departamentListViewModel($request);

        return view('departament.departaments', [
            'viewModel' => $viewModel,
        ]);
    }

    private function departamentListViewModel(Request $request): DepartamentListViewModel
    {
        try {
            $response = $this->backendApiClient->get($request, 'departaments.list');

            if (! $response->successful()) {
                return new DepartamentListViewModel(
                    errorMessage: $this->backendApiClient->errorMessage(
                        $response,
                        'Nao foi possivel carregar os departamentos.',
                    ),
                );
            }

            $departaments = $response->json('data');

            return new DepartamentListViewModel(
                departaments: is_array($departaments) ? $departaments : [],
                errorMessage: is_array($departaments)
                    ? null
                    : 'Resposta invalida ao listar departamentos.',
            );
        } catch (Throwable) {
            return new DepartamentListViewModel(
                errorMessage: 'Nao foi possivel carregar os departamentos.'
            );
        }
    }
}
