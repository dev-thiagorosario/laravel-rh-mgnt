<?php

declare(strict_types=1);

namespace App\Actions;

interface ListDepartamentActionInterface
{
    /**
     * @return array{
     *     departaments: list<array<string, mixed>>
     * }
     */
    public function list(): array;
}
