<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\CodeException;
use Throwable;

class ListDepartamentException extends \RuntimeException
{
    public function __construct(
        string $message = 'Erro ao listar departamentos.',
        int $code = CodeException::ERROR_LIST_DEPARTAMENT->value,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
