<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\ListDepartamentActionInterface;
use App\Entities\ResponseJsend;
use App\Exceptions\ListDepartamentException;
use Illuminate\Http\JsonResponse;
use Throwable;

final class ListDepartamentController extends Controller
{
    public function __construct(
        private readonly ListDepartamentActionInterface $listDepartamentAction,
    ) {}

    public function __invoke(): JsonResponse
    {
        try {
            $data = $this->listDepartamentAction->list();

            $response = new ResponseJsend(
                data: $data,
            );

            return response()
                ->json($response->toArray(), 200);
        } catch (ListDepartamentException $e) {
            $response = new ResponseJsend(
                status: 'error',
                message: $e->getMessage(),
                code: $e->getCode(),
            );

            return response()
                ->json($response->toArray(), 400);
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
