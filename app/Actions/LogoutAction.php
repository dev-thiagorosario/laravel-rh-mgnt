<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Support\Facades\Auth;

class LogoutAction implements LogoutActionInterface
{
    public function execute(): void
    {
        $user = Auth::user();

        $userId = $user->id;

        if($user !== null && method_exists($user, 'currentAccessToken')){
            $user->currentAccessToken()->delete();
        }

        if ($userId !== null) {
            Auth::logout();
        }
    }
}
