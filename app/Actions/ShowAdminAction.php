<?php

declare(strict_types=1);

namespace App\Actions;

use App\Entities\UserEntity;
use App\Exceptions\AdminViewException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ShowAdminAction implements ShowAdminActionInterface
{
    public function execute(): UserEntity
    {
        $userId = Auth::id();

        if ($userId === null) {
            throw new AdminViewException('Usuário não autenticado.');
        }

        $admin = User::query()
            ->with(['detail', 'departament'])
            ->find($userId);

        if ($admin === null) {
            throw new AdminViewException('Administrador não encontrado.');
        }

        return UserEntity::fromModel($admin);
    }
}
