<?php

declare(strict_types=1);

namespace App\Enums;

enum CodeException: int
{
    case ERROR_CREATE_USER = 1003;
    case ERROR_LOGIN = 1004;
    case ERROR_LOGOUT = 1005;
    case ERROR_RESET_PASSWORD = 1006;
    case UPDATE_USER_PROFILE = 1008;
    case ERROR_USER_NOT_FOUND = 1009;
    case ERROR_USER_INACTIVE = 1010;
    case ERROR_USER_BLOCKED = 1011;
    case ERROR_LOGIN_PROCESS = 1012;
    case ERROR_LIST_DEPARTAMENT = 2001;

    case ERROR_CREATE_DEPARTAMENT = 2002;
}
