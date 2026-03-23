<?php

declare(strict_types=1);

namespace App\View\Http\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

final class ProfileViewController extends Controller
{
    public function __invoke(): View
    {
        return view('user-profile');
    }
}
