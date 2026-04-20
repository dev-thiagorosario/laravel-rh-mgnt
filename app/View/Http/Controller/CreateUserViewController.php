<?php

declare(strict_types=1);

namespace App\View\Http\Controller;

use App\Enums\UserPermissionEnum;
use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\View\Http\BackendApiClient;
use App\View\Models\CreateUserViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Throwable;

final class CreateUserViewController extends Controller
{
    public function __construct(
        private readonly BackendApiClient $backendApiClient,
    ) {
    }

    public function __invoke(Request $request): View
    {
        $viewModel = new CreateUserViewModel(
            departments: $this->departments($request),
            roles: UserRoleEnum::options(),
            permissions: UserPermissionEnum::options(),
        );

        return view('users.create', [
            'viewModel' => $viewModel,
            'submitUrl' => route('users.store'),
        ]);
    }

    private function departments(Request $request): array
    {
        try {
            $response = $this->backendApiClient->get($request, 'departaments.list');
            $departments = $response->json('data');

            return $response->successful() && is_array($departments)
                ? $departments
                : [];
        } catch (Throwable) {
            return [];
        }
    }
}
