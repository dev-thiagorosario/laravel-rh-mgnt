<?php

declare(strict_types=1);

namespace App\View\Http\Controller;

use App\Actions\ListDepartmentActionInterface;
use App\Enums\UserPermissionEnum;
use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\View\Models\CreateUserViewModel;
use Illuminate\Contracts\View\View;

final class CreateUserViewController extends Controller
{
    public function __construct(
        private readonly ListDepartmentActionInterface $listDepartamentAction,
    ) {
    }

    public function __invoke(): View
    {
        $viewModel = new CreateUserViewModel(
            departments: $this->listDepartamentAction->list(),
            roles: UserRoleEnum::options(),
            permissions: UserPermissionEnum::options(),
        );

        return view('users.create', [
            'viewModel' => $viewModel,
            'submitUrl' => route('users.store'),
        ]);
    }
}
