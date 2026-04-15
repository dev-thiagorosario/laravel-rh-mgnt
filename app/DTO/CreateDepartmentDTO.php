<?php

declare(strict_types=1);

namespace App\DTO;


class CreateDepartmentDTO
{
    public function __construct(
        public string $name,
        public string $description,
    ){}

    public static function fromArray(array $data): self
    {
        return new self(
            name: (string) $data['name'],
            description: (string) $data['description'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}
