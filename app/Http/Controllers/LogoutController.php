<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\LogoutActionInterface;
use App\Entities\ResponseJsend;
use App\Exceptions\LogoutException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class LogoutController extends Controller
{
    public function __construct(
        private readonly LogoutActionInterface $logoutAction,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $this->logoutAction->execute();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $response = new ResponseJsend(
                data: ['authenticated' => false],
            );

            return response()
            ->json($response->toArray(), 200);
        } catch (LogoutException $e) {
            $response = new ResponseJsend(
                status: 'error',
                message: $e->getMessage(),
                code: $e->getCode(),
            );

            return response()
            ->json($response->toArray(), 500);
        } catch (Throwable $e) {
            $response = new ResponseJsend(
                status: 'error',
                message: $e->getMessage(),
                code: $e->getCode(),
            );

            return response()
            ->json($response->toArray(), 500);
        }
    }
}
