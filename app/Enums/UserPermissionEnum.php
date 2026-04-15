<?php

declare(strict_types=1);

namespace App\Enums;

enum UserPermissionEnum: string
{
    case USERS_READ = 'users.read';
    case USERS_WRITE = 'users.write';
    case DEPARTAMENTS_READ = 'departaments.read';
    case DEPARTAMENTS_WRITE = 'departaments.write';
    case REPORTS_READ = 'reports.read';

    public function label(): string
    {
        return match ($this) {
            self::USERS_READ => 'Visualizar usuarios',
            self::USERS_WRITE => 'Editar usuarios',
            self::DEPARTAMENTS_READ => 'Visualizar departamentos',
            self::DEPARTAMENTS_WRITE => 'Editar departamentos',
            self::REPORTS_READ => 'Visualizar relatorios',
        };
    }

    public static function options(): array
    {
        return array_map(
            static fn (self $permission): array => [
                'value' => $permission->value,
                'label' => $permission->label(),
            ],
            self::cases()
        );
    }
}
