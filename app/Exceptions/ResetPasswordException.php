<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\CodeException;
use RuntimeException;
use Throwable;

class ResetPasswordException extends RuntimeException
{
    public function __construct(
        string $message = 'Erro ao resetar senha.',
        int $code = CodeException::ERROR_RESET_PASSWORD->value,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
