<?php

declare(strict_types=1);

namespace App\Entities;

use App\Models\User;
use DateTimeInterface;

class UserEntity
{
    protected ?int $id = null;
    protected ?string $name = null;
    protected ?string $email = null;
    protected ?string $password = null;
    protected ?string $role = null;
    protected ?string $permissions = null;
    protected ?int $departament_id = null;
    protected ?string $departament_name = null;
    protected ?string $created_at = null;
    protected ?string $updated_at = null;
    protected ?UserDetailEntity $detail = null;
    protected ?DepartamentEntity $department = null;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;
        return $this;
    }

    public function getPermissions(): ?string
    {
        return $this->permissions;
    }

    public function setPermissions(?string $permissions): self
    {
        $this->permissions = $permissions;
        return $this;
    }

    public function getDepartamentId(): ?int
    {
        return $this->departament_id;
    }

    public function setDepartamentId(?int $departament_id): self
    {
        $this->departament_id = $departament_id;
        return $this;
    }

    public function getDepartamentName(): ?string
    {
        return $this->departament_name;
    }

    public function setDepartamentName(?string $departament_name): self
    {
        $this->departament_name = $departament_name;
        return $this;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function setCreatedAt(?string $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?string $updated_at): self
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    public function getDetail(): ?UserDetailEntity
    {
        return $this->detail;
    }

    public function setDetail(?UserDetailEntity $detail): self
    {
        $this->detail = $detail;
        return $this;
    }

    public function getDepartment(): ?DepartamentEntity
    {
        return $this->department;
    }

    public function setDepartment(?DepartamentEntity $department): self
    {
        $this->department = $department;
        return $this;
    }

    public static function fromModel(User $user): self
    {
        $createdAt = $user->created_at;
        $updatedAt = $user->updated_at;

        $entity = new self();
        $entity->setId($user->id);
        $entity->setName($user->name);
        $entity->setEmail($user->email);
        $entity->setPassword($user->password);
        $entity->setRole($user->role);
        $entity->setPermissions($user->permissions ?? '[]');
        $entity->setDepartamentId($user->departament_id);
        $entity->setDepartamentName($user->departament?->name);
        $entity->setCreatedAt($createdAt instanceof DateTimeInterface ? $createdAt->format('Y-m-d H:i:s') : (is_string($createdAt) ? $createdAt : null));
        $entity->setUpdatedAt($updatedAt instanceof DateTimeInterface ? $updatedAt->format('Y-m-d H:i:s') : (is_string($updatedAt) ? $updatedAt : null));
        $entity->setDetail($user->detail !== null ? UserDetailEntity::fromModel($user->detail) : null);
        $entity->setDepartment($user->departament !== null ? DepartamentEntity::fromModel($user->departament) : null);

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
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'role' => $this->getRole(),
            'permissions' => $this->getPermissions(),
            'departament_id' => $this->getDepartamentId(),
            'departament_name' => $this->getDepartamentName(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
            'detail' => $this->getDetail()?->toArray(),
            'department' => $this->getDepartment()?->toArray(),
        ];
    }
}
