<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateDepartmentActionInterface;
use App\DTO\CreateDepartmentDTO;
use App\Entities\ResponseJsend;
use App\Exceptions\CreateDepartmentException;
use App\Http\Requests\CreateDepartmentRequest;
use Illuminate\Http\JsonResponse;
use Throwable;

class CreateDepartmentController extends Controller
{
    public function __construct(
        private readonly CreateDepartmentActionInterface $createDepartamentAction,
    ) {}

    public function __invoke(CreateDepartmentRequest $request): JsonResponse
    {
        try {
            $dto = CreateDepartmentDTO::fromArray($request->validated());

            $departament = $this->createDepartamentAction->create($dto);

            $response = new ResponseJsend([
                'departament' => $departament->toArray(),
            ]);

            return response()
                ->json($response->toArray(), 201);
        } catch (CreateDepartmentException $e) {
            $response = new ResponseJsend(
                status: 'error',
                message: $e->getMessage(),
                code: $e->getCode(),
            );

            return response()
                ->json($response->toArray(), 400);
        } catch (Throwable $e) {
            report($e);

            $response = new ResponseJsend(
                status: 'error',
                message: 'Erro interno ao criar departamento.',
                code: 500,
            );

            return response()
                ->json($response->toArray(), 500);
        }
    }
}
