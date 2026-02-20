<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\LogoutActionInterface;
use App\Entities\ResponseJsend;
use Illuminate\Http\JsonResponse;

class LogoutController extends Controller
{
    public function __construct(
        private readonly LogoutActionInterface $logoutAction
    ){}

    public function __invoke():JsonResponse
    {
        try {
            $logout = $this->logoutAction->execute();

            $data = [
                'message' => 'Logout Efetuado com Sucesso!',
            ];

            $result = new ResponseJsend($data, 'success');

            return response()
                ->json($result->toArray(), 200);
        }catch (\Throwable $e) {
            return response()->json(['message' => 'Erro ao efetuar logout'], 500);
        }
    }
}
