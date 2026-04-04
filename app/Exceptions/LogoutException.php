<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\CodeException;
use Throwable;

class LogoutException extends \RuntimeException
{
    public function __construct(
        string $message = 'Ocorreu um erro ao efetuar logout.',
        int $code = CodeException::ERROR_LOGOUT->value,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
