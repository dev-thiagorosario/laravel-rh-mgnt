<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\CodeException;
use Throwable;

class UserNotFoundException extends \RuntimeException
{
    public function __construct(
        string $message = 'Usuario nao encontrado.',
        int $code = CodeException::ERROR_USER_NOT_FOUND->value,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
