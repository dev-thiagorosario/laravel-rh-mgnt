<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\LoginActionInterface;
use App\DTO\LoginInputDTO;
use App\Entities\ResponseJsend;
use App\Exceptions\InvalidCredentialsException;
use App\Exceptions\LoginProcessException;
use App\Exceptions\UserBlockedException;
use App\Exceptions\UserInactiveException;
use App\Http\Requests\LoginRequest;
use App\Traits\PresentLoginTrait;
use Illuminate\Http\JsonResponse;
use Throwable;

final class LoginController extends Controller
{
    use PresentLoginTrait;

    public function __construct(
        private readonly LoginActionInterface $loginAction,
    ) {}

    public function __invoke(LoginRequest $request): JsonResponse
    {
        try {
            $dto = LoginInputDTO::fromArray($request->validated());

            $auth = $this->loginAction->execute($dto);

            $data = $this->initializePresentLoginTrait($auth);

            $response = new ResponseJsend($data);

            return response()
            ->json($response->toArray(), 200);
        } catch (InvalidCredentialsException $e) {
            $response = new ResponseJsend(
                status: 'error',
                message: $e->getMessage(),
                code: $e->getCode(),
            );

            return response()->json($response->toArray(), 401);
        } catch (UserInactiveException|UserBlockedException $e) {
            $response = new ResponseJsend(
                status: 'error',
                message: $e->getMessage(),
                code: $e->getCode(),
            );

            return response()
            ->json($response->toArray(), 403);
        } catch (Throwable $e) {
            $exception = new LoginProcessException(previous: $e);
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
