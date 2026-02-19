<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateUserActionInterface;
use App\DTO\CreateUserDTO;
use App\Entities\ResponseJsend;
use App\Exceptions\CreateUserException;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Throwable;

class CreateUserController extends Controller
{
    public function __construct(
        private readonly CreateUserActionInterface $createUserAction
    ) {}

    public function __invoke(CreateUserRequest $request): JsonResponse|RedirectResponse
    {
        try {
            $dto = CreateUserDTO::fromRequest($request->validated());

            $user = $this->createUserAction->execute($dto);

            $userData = $user->toArray();

            unset($userData['password']);

            $result = new ResponseJsend(
                data: ['user' => $userData],
                status: 'success',
            );

            return response()
                ->json($result->toArray(), 201);
        } catch (CreateUserException $e) {
            $result = new ResponseJsend(
                data: [],
                status: 'fail',
                message: $e->getMessage(),
                code: $e->getCode(),
            );

            return response()->json($result->toArray(), 400);
        } catch (Throwable $e) {
            $result = new ResponseJsend(
                data: [],
                status: 'error',
                message: 'An unexpected error occurred.',
            );
            }

            return response()->json($result->toArray(), 500);
        }
}
