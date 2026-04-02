<?php

declare(strict_types=1);

namespace App\View\Http\Controller;

use App\Http\Controllers\Controller;
use App\View\Models\CreateUserViewModel;
use Illuminate\Contracts\View\View;
use Throwable;

final class CreateUserViewController extends Controller
{
    public function __invoke(): View
    {
        return view('users.create');
    }
}
