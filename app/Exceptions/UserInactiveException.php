<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\CodeException;
use Throwable;

class UserInactiveException extends \RuntimeException
{
    public function __construct(
        string $message = 'Usuario inativo.',
        int $code = CodeException::ERROR_USER_INACTIVE->value,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
