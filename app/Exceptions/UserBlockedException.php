<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\CodeException;
use Throwable;

class UserBlockedException extends \RuntimeException
{
    public function __construct(
        string $message = 'Usuario bloqueado.',
        int $code = CodeException::ERROR_USER_BLOCKED->value,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
