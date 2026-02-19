<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;

class CreateUserPolicy
{
    /**
     * $targetDepartamentId = departament_id que o novo usuário vai receber
     */
    public function create(User $user, int $targetDepartamentId): bool
    {
        // Admin pode criar em qualquer departamento
        if ($user->role === 'admin') {
            return true;
        }

        // Manager só cria dentro do próprio departamento
        if ($user->role === 'manager') {
            return (int) $user->departament_id === (int) $targetDepartamentId;
        }

        // Employee (ou qualquer outro) não cria
        return false;
    }
}
