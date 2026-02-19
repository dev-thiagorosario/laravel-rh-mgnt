<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\CodeException;
use Throwable;

class CreateUserException extends \RuntimeException
{
    public function __construct(
        string $message = 'Erro ao criar usuario.',
        int $code = CodeException::ERROR_CREATE_USER->value,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
