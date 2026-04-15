<?php

declare(strict_types=1);

namespace App\Actions;

interface GetAuthenticatedUserViewDataActionInterface
{
    public function execute(): array;
}
