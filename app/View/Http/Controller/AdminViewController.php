<?php

declare(strict_types=1);

namespace App\View\Http\Controller;

use App\Actions\ShowAdminActionInterface;
use App\Exceptions\AdminViewException;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Throwable;

class AdminViewController extends Controller
{
    public function __construct(
        private readonly ShowAdminActionInterface $showAdminAction
    ) {}

    public function __invoke(): View
    {
        try {
            return view('dashboard', [
                'admin' => $this->showAdminAction->execute()->toArray(),
            ]);
        } catch (AdminViewException $e) {
            abort(
                500,
                $e->getMessage());
        } catch (Throwable) {
            abort(500,
                'An unexpected error occurred.');
        }
    }
}
