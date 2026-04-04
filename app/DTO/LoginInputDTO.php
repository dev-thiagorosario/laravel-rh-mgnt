<?php

declare(strict_types=1);

namespace App\DTO;

final class LoginInputDTO
{
    public function __construct(
        public readonly string $login,
        public readonly string $password,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            login: trim((string) ($data['login'] ?? $data['email'] ?? '')),
            password: (string) ($data['password'] ?? ''),
        );
    }
}
