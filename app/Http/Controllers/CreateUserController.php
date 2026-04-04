<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateUserActionInterface;
use App\DTO\CreateUserDTO;
use App\Entities\ResponseJsend;
use App\Exceptions\CreateUserException;
use App\Http\Requests\CreateUserRequest;
use App\Traits\PresentUserTrait;
use Illuminate\Http\JsonResponse;
use Throwable;

final class CreateUserController extends Controller
{
    use PresentUserTrait;

    public function __construct(
        private readonly CreateUserActionInterface $createUserAction,
    ) {}

    public function __invoke(CreateUserRequest $request): JsonResponse
    {
        try {
            $dto = CreateUserDTO::fromRequest($request->validated());

            $user = $this->createUserAction->execute($dto);

            $data = [
                'user' => $this->presentUser($user),
            ];

            $response = new ResponseJsend($data);

            return response()
            ->json($response->toArray(), 201);
        } catch (CreateUserException $e) {
            $response = new ResponseJsend(
                status: 'error',
                message: $e->getMessage(),
                code: $e->getCode(),
            );

            return response()
            ->json($response->toArray(), 400);
        } catch (Throwable $e) {
            $exception = new CreateUserException(previous: $e);
            $response = new ResponseJsend(
                status: 'error',
                message: $exception->getMessage(),
                code: $exception->getCode(),
            );

            return response()
            ->json($response->toArray(), 500);
        }
    }
}
