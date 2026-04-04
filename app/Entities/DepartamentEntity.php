<?php

declare(strict_types=1);

namespace App\Entities;

use App\Models\Departament;

class DepartamentEntity
{
    protected ?int $id = null;
    protected ?string $name = null;

    protected ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public static function fromModel(Departament $departament): self
    {
        $entity = new self();
        $entity->setId($departament->id);
        $entity->setName($departament->name);
        $entity->setDescription($departament->description);

        return $entity;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
        ];
    }
}
