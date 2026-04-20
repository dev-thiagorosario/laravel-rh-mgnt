<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\GetAuthenticatedUserViewDataActionInterface;
use App\Entities\ResponseJsend;
use Illuminate\Http\JsonResponse;
use Throwable;

final class AuthenticatedUserViewDataController extends Controller
{
    public function __construct(
        private readonly GetAuthenticatedUserViewDataActionInterface $getAuthenticatedUserViewDataAction,
    ) {
    }

    public function __invoke(): JsonResponse
    {
        try {
            $response = new ResponseJsend(
                data: $this->getAuthenticatedUserViewDataAction->execute(),
            );

            return response()
            ->json($response->toArray(), 200);
        } catch (Throwable) {
            $response = new ResponseJsend(
                status: 'error',
                message: 'Nao foi possivel carregar os dados do usuario autenticado.',
            );

            return response()->json($response->toArray(), 500);
        }
    }
}
