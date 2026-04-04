<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\CodeException;
use Throwable;

class LoginProcessException extends \RuntimeException
{
    public function __construct(
        string $message = 'Ocorreu um erro inesperado ao processar o login.',
        int $code = CodeException::ERROR_LOGIN_PROCESS->value,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
