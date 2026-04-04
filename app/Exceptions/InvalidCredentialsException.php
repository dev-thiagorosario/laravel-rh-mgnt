<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\CodeException;
use Throwable;

class InvalidCredentialsException extends \RuntimeException
{
    public function __construct(
        string $message = 'Login ou senha incorretos.',
        int $code = CodeException::ERROR_LOGIN->value,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
