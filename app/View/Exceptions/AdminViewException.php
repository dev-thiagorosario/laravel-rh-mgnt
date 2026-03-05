<?php

declare(strict_types=1);

namespace App\View\Exceptions;

use App\Enums\CodeException;
use Throwable;

class AdminViewException extends \RuntimeException
{
    public function __construct(
        string $message = "Error ao abrir a pagina do adminsitrador",
        int $code = CodeException::ERROR_ADMIN_VIEW->value,
        ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
