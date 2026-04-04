<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\ResetPasswordActionInterface;
use App\Entities\ResponseJsend;
use App\Exceptions\ResetPasswordException;
use App\Http\Requests\ResetPasswordRequest;
use App\Traits\PresentResetPasswordTrait;
use Illuminate\Http\JsonResponse;
use Throwable;

final class ResetPasswordController extends Controller
{
    use PresentResetPasswordTrait;

    public function __construct(
        private readonly ResetPasswordActionInterface $resetPasswordAction,
    ) {}

    public function __invoke(ResetPasswordRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            $user = $this->resetPasswordAction->execute((int) $validated['user_id']);

            $data = $this->initializePresentResetPasswordTrait($user);

            $response = new ResponseJsend(
                message: $this->resetPasswordSuccessMessage(),
                data: $data,
            );

            return response()
            ->json($response->toArray(), 200);
        } catch (ResetPasswordException $e) {
            $response = new ResponseJsend(
                status: 'error',
                message: $e->getMessage(),
                code: $e->getCode(),
            );

            return response()->json($response->toArray(), 400);
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
