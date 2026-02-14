<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\ShowAdminActionInterface;
use App\Exceptions\AdminViewException;
use Illuminate\Contracts\View\View;
use Throwable;

class AdminViewController extends Controller
{
    public function __construct(
        private readonly ShowAdminActionInterface $showAdminAction
    ) {
    }

    public function __invoke(): View
    {
        try {
            return view('admin', ['admin' => $this->showAdminAction->execute()]);
        } catch (AdminViewException $e) {
            abort(500, $e->getMessage());
        } catch (Throwable) {
            abort(500, 'An unexpected error occurred.');
        }
    }
}
