<?php

declare(strict_types=1);

namespace App\Enums;

enum CodeException: int
{
    case ERROR_ADMIN_VIEW = 1001;
    case ERROR_LOGIN_VIEW = 1002;
}
