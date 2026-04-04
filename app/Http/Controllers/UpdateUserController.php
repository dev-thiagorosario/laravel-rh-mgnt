<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\UpdateUserActionInterface;
use App\DTO\UpdateUserDTO;
use App\Entities\ResponseJsend;
use App\Exceptions\UpdateUserException;
use App\Exceptions\UserNotFoundException;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

class UpdateUserController extends Controller
{
    public function __construct(
        private readonly UpdateUserActionInterface $updateUserAction,
    ) {}

    public function __invoke(UpdateUserRequest $request, ?int $userId = null): JsonResponse
    {
        try {
            $data = $request->validated();
            $userId ??= (int) Auth::id();

            $dto = UpdateUserDTO::fromArray($data);

            $this->updateUserAction->update($userId, $dto->toArray());

            $response = new ResponseJsend();

            return response()->json($response->toArray(), 200);
        } catch (UserNotFoundException $e) {
            $response = new ResponseJsend(
                status: 'error',
                message: $e->getMessage(),
                code: $e->getCode(),
            );

            return response()->json($response->toArray(), 404);
        } catch (UpdateUserException $e) {
            $response = new ResponseJsend(
                status: 'error',
                message: $e->getMessage(),
                code: $e->getCode(),
            );

            return response()->json($response->toArray(), 500);
        } catch (Throwable $e) {
            $exception = new UpdateUserException(previous: $e);

            $response = new ResponseJsend(
                status: 'error',
                message: $exception->getMessage(),
                code: $exception->getCode(),
            );

            return response()->json($response->toArray(), 500);
        }
    }
}
