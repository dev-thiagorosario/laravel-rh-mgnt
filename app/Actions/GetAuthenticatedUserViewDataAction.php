<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

final class GetAuthenticatedUserViewDataAction implements GetAuthenticatedUserViewDataActionInterface
{
    public function execute(): array
    {
        $user = Auth::user();

        if (! $user instanceof User) {
            return [
                'name' => 'Usuario',
                'email' => 'Email indisponivel',
                'role' => 'Sem perfil',
                'department' => 'Sem departamento',
                'created_at' => null,
            ];
        }

        $user->loadMissing('departament');

        return [
            'name' => $user->name ?? 'Usuario',
            'email' => $user->email ?? 'Email indisponivel',
            'role' => $user->role ?? 'Sem perfil',
            'department' => $user->departament?->name ?? 'Sem departamento',
            'created_at' => $user->created_at,
        ];
    }
}
