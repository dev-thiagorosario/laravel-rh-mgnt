<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\ListDepartmentActionInterface;
use App\Entities\ResponseJsend;
use App\Exceptions\ListDepartmentException;
use Illuminate\Http\JsonResponse;
use Throwable;

final class ListDepartmentController extends Controller
{
    public function __construct(
        private readonly ListDepartmentActionInterface $listDepartamentAction,
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
        } catch (ListDepartmentException $e) {
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
