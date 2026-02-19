<?php

declare(strict_types=1);


namespace App\DTO;

class CreateUserDTO
{
    /**
     * @param array<int, string> $permissions
     */
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public int $departament_id,
        public string $role,
        public array $permissions,
    ) {}

    public static function fromRequest(array $data): self
    {
        $permissions = array_values(array_unique(array_map('strval', (array) ($data['permissions'] ?? []))));

        return new self(
            name: (string) $data['name'],
            email: (string) $data['email'],
            password: (string) $data['password'],
            departament_id: (int) $data['departament_id'],
            role: (string) $data['role'],
            permissions: $permissions,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'departament_id' => $this->departament_id,
            'role' => $this->role,
            'permissions' => json_encode($this->permissions, JSON_THROW_ON_ERROR),
        ];
    }
}
