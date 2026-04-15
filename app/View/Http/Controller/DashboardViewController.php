<?php

declare(strict_types=1);

namespace App\View\Http\Controller;

use App\Actions\GetAuthenticatedUserViewDataActionInterface;
use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\View\Models\DashboardViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

final class DashboardViewController extends Controller
{
    public function __construct(
        private readonly GetAuthenticatedUserViewDataActionInterface $getAuthenticatedUserViewDataAction,
    ) {
    }

    public function __invoke(): View
    {
        $userData = $this->getAuthenticatedUserViewDataAction->execute();
        $canCreateUser = $userData['role'] !== UserRoleEnum::EMPLOYEE->value
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
}
