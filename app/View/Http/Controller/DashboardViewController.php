<?php

declare(strict_types=1);

namespace App\View\Http\Controller;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\View\Http\BackendApiClient;
use App\View\Models\DashboardViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Throwable;

final class DashboardViewController extends Controller
{
    public function __construct(
        private readonly BackendApiClient $backendApiClient,
    ) {
    }

    public function __invoke(Request $request): View
    {
        $userData = $this->authenticatedUserData($request);
        $canCreateUser = in_array(
            $userData['role'],
            [UserRoleEnum::ADMIN->value, UserRoleEnum::MANAGER->value],
            true,
        )
            && Route::has('users.create');

        $viewModel = new DashboardViewModel(
            profileUrl: route('user.profile'),
            canCreateUser: $canCreateUser,
            createUserUrl: $canCreateUser ? route('users.create') : null,
        );

        return view('dashboard', [
            'viewModel' => $viewModel,
        ]);
    }

    private function authenticatedUserData(Request $request): array
    {
        try {
            $response = $this->backendApiClient->get($request, 'authenticated-user.view-data');
            $data = $response->json('data');

            if ($response->successful() && is_array($data)) {
                return $data;
            }
        } catch (Throwable) {
        }

        return [
            'name' => 'Usuario',
            'email' => 'Email indisponivel',
            'role' => 'Sem perfil',
            'department' => 'Sem departamento',
            'created_at' => null,
        ];
    }
}
