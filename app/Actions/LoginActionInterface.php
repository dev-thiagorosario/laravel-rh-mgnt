<?php

declare(strict_types=1);

namespace App\Actions;

interface LoginActionInterface
{
    /**
     * @param array{email:string,password:string} $credentials
     */
    public function execute(array $credentials): void;
}
