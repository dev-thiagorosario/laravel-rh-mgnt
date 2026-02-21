<?php

declare(strict_types=1);

namespace App\View\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserBarViewModel extends Model
{
    public function name(): string
    {
        return $this->user()?->name ?? 'Usuario';
    }

    public function department(): string
    {
        $user = $this->user();

        if ($user === null) {
            return 'Sem departamento';
        }

        $user->loadMissing('departament');

        return $user->departament?->name ?? 'Sem departamento';
    }

    private function user(): ?User
    {
        $user = auth()->user();

        return $user instanceof User ? $user : null;
    }
}
