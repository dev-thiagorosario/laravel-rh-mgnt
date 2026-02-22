<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\ResetPasswordActionInterface;
use App\Entities\ResponseJsend;
use App\Exceptions\ResetPasswordException;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Throwable;

class ResetPasswordController extends Controller
{
    public function __construct(
        private readonly ResetPasswordActionInterface $resetPasswordAction
    ) {}

    public function __invoke(ResetPasswordRequest $request): JsonResponse|RedirectResponse
    {
        try {
            $validated = $request->validated();

            $user = $this->resetPasswordAction->execute((int) $validated['user_id']);

            $result = new ResponseJsend(
                message: 'Senha resetada com sucesso.',
                data: [
                    'user' => [
                        'id' => $user->getId(),
                        'name' => $user->getName(),
                        'email' => $user->getEmail(),
                    ]
                ],
                status: 'success',
            );

            return response()
            ->json($result->toArray(), 200);
        } catch (ResetPasswordException $e) {
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

            return response()->json($result->toArray(), 500);
        }
    }
}