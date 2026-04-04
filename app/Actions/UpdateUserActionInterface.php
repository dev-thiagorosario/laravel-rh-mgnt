<?php

declare(strict_types=1);

namespace App\Actions;

interface UpdateUserActionInterface
{
    public function update(int $userId, array $data): void;
}
