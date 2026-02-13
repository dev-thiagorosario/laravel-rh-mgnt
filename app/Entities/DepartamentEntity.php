<?php

declare(strict_types=1);

namespace App\Entities;

use App\Models\Departament;

class DepartamentEntity
{
    protected ?int $id = null;
    protected ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }
    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
    public function fromModel(Departament $departament): self
    {
        $entity = new self();
        $entity->setId($departament->id ?? null);
        $entity->setName($departament->name ?? '');
        return $entity;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
        ];
    }

}
