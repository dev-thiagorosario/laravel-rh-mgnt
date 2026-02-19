<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\CodeException;
use Throwable;

class LoginViewException extends \RuntimeException
{
    public function __construct(
        string $message = 'Erro ao abrir a página de login.',
        int $code = CodeException::ERROR_LOGIN_VIEW->value,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
