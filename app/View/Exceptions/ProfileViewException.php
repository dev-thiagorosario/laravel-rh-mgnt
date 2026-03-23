<?php

declare(strict_types=1);

namespace App\View\Exceptions;

use App\Enums\CodeException;
use Throwable;


class ProfileViewException extends \RuntimeException
{
    public function __construct(
        string $message = 'Error ao abrir a pagina de perfil do usuário',
        int $code = CodeException::ERROR_PROFILE_VIEW->value,
        ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
