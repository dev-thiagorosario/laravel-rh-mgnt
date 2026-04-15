<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\CodeException;
use Throwable;

class CreateDepartmentException extends \RuntimeException
{
    public function __construct(
        string $message = 'Erro ao criar departamento.',
        int $code = CodeException::ERROR_CREATE_DEPARTAMENT->value,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
