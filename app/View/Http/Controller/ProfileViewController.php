<?php

declare(strict_types=1);

namespace App\View\Http\Controller;

use App\Actions\GetAuthenticatedUserViewDataActionInterface;
use App\Http\Controllers\Controller;
use App\Presenter\DateFormatPresenter;
use App\View\Models\UserProfileViewModel;
use Illuminate\Contracts\View\View;

final class ProfileViewController extends Controller
{
    public function __construct(
        private readonly GetAuthenticatedUserViewDataActionInterface $getAuthenticatedUserViewDataAction,
        private readonly DateFormatPresenter $dateFormatPresenter,
    ) {
    }

    public function __invoke(): View
    {
        $userData = $this->getAuthenticatedUserViewDataAction->execute();

        $viewModel = new UserProfileViewModel(
            userName: $userData['name'],
            userRole: $userData['role'],
            userEmail: $userData['email'],
            userDepartment: $userData['department'],
            createdAt: $userData['created_at'] !== null
                ? $this->dateFormatPresenter->present($userData['created_at'])['formatted']
                : 'Data indisponivel',
        );

        return view('user-profile', [
            'viewModel' => $viewModel,
        ]);
    }
}
