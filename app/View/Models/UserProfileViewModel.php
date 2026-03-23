<?php

declare(strict_types=1);

namespace App\View\Models;

use App\Entities\UserEntity;
use App\Models\User;
use App\Presenter\DateFormatPresenter;
use Illuminate\Support\Facades\Auth;

final class UserProfileViewModel
{
    private ?UserEntity $userEntity = null;

    public function __construct(
        private readonly DateFormatPresenter $dateFormatPresenter,
    ) {
    }

    public function userName(): string
    {
        return $this->userEntity()->getName() ?? 'Usuario';
    }

    public function userRole(): string
    {
        return $this->userEntity()->getRole() ?? 'Sem perfil';
    }

    public function userEmail(): string
    {
        return $this->userEntity()->getEmail() ?? 'Email indisponivel';
    }

    public function userDepartment(): string
    {
        return $this->userEntity()->getDepartamentName() ?? 'Sem departamento';
    }

    public function createdAt(): string
    {
        $createdAt = $this->userEntity()->getCreatedAt();

        if ($createdAt === null) {
            return 'Data indisponivel';
        }

        return $this->dateFormatPresenter->present($createdAt)['formatted'];
    }

    private function userEntity(): UserEntity
    {
        if ($this->userEntity !== null) {
            return $this->userEntity;
        }

        $user = Auth::user();

        if (! $user instanceof User) {
            return $this->userEntity = new UserEntity();
        }

        $user->loadMissing('departament');

        return $this->userEntity = UserEntity::fromModel($user);
    }
}
