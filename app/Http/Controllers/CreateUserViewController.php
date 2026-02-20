<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\View\Models\CreateUserViewModel;
use Illuminate\Contracts\View\View;
use Throwable;

final class CreateUserViewController extends Controller
{
    public function __construct(
        private readonly CreateUserViewModel $vm,
    ) {}

    public function __invoke(): View
    {
        try {
            return view('users.create', [
                'departments' => $this->vm->departments(),
                'roles' => $this->vm->roles(),
                'permissions' => $this->vm->permissions(),
                'submitUrl' => route('users.store'),
            ]);
        }  catch (Throwable $e) {
            abort(500, 'An unexpected error occurred.');
        }
    }
}
