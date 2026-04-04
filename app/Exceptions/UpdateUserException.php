<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\CodeException;

class UpdateUserException extends \RuntimeException
{
    public function __construct(
        string $message = 'Ocorreu um erro ao atualizar o usuario.',
        int $code = CodeException::UPDATE_USER_PROFILE->value,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
