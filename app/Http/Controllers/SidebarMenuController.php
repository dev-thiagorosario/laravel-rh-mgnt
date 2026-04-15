<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\ResolveSidebarMenuActionInterface;
use App\Entities\ResponseJsend;
use Illuminate\Http\JsonResponse;
use Throwable;

final class SidebarMenuController extends Controller
{
    public function __construct(
        private readonly ResolveSidebarMenuActionInterface $resolveSidebarMenuAction,
    ) {
    }

    public function __invoke(): JsonResponse
    {
        try {
            $response = new ResponseJsend(
                data: $this->resolveSidebarMenuAction->execute(),
            );

            return response()
            ->json($response->toArray(), 200);
        } catch (Throwable) {
            $response = new ResponseJsend(
                status: 'error',
                message: 'Nao foi possivel carregar o menu lateral.',
            );

            return response()->json($response->toArray(), 500);
        }
    }
}
