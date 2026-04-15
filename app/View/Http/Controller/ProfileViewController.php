<?php

declare(strict_types=1);

namespace App\View\Http\Controller;

use App\Http\Controllers\Controller;
use App\Presenter\DateFormatPresenter;
use App\View\Http\BackendApiClient;
use App\View\Models\UserProfileViewModel;
use DateTimeImmutable;
use DateTimeInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Throwable;

final class ProfileViewController extends Controller
{
    public function __construct(
        private readonly BackendApiClient $backendApiClient,
        private readonly DateFormatPresenter $dateFormatPresenter,
    ) {
    }

    public function __invoke(Request $request): View
    {
        $userData = $this->authenticatedUserData($request);

        $viewModel = new UserProfileViewModel(
            userName: $userData['name'],
            userRole: $userData['role'],
            userEmail: $userData['email'],
            userDepartment: $userData['department'],
            createdAt: $this->formattedCreatedAt($userData['created_at'] ?? null),
        );

        return view('user-profile', [
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

    private function formattedCreatedAt(mixed $createdAt): string
    {
        if ($createdAt instanceof DateTimeInterface) {
            return $this->dateFormatPresenter->present($createdAt)['formatted'];
        }

        if (! is_string($createdAt) || $createdAt === '') {
            return 'Data indisponivel';
        }

        try {
            return $this->dateFormatPresenter
                ->present(new DateTimeImmutable($createdAt))['formatted'];
        } catch (Throwable) {
            return 'Data indisponivel';
        }
    }
}
