<?php

declare(strict_types=1);

namespace App\Entities;

use App\Models\User;
use DateTimeImmutable;
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
    protected ?DateTimeInterface $created_at = null;
    protected ?DateTimeInterface $updated_at = null;
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

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?DateTimeInterface $updated_at): self
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
        $entity = new self();
        $entity->setId($user->id);
        $entity->setName($user->name);
        $entity->setEmail($user->email);
        $entity->setPassword($user->password);
        $entity->setRole($user->role);
        $entity->setPermissions($user->permissions ?? '[]');
        $entity->setDepartamentId($user->departament_id);
        $entity->setDepartamentName($user->departament?->name);
        $entity->setCreatedAt(self::normalizeDate($user->created_at));
        $entity->setUpdatedAt(self::normalizeDate($user->updated_at));
        $entity->setDetail($user->detail !== null ? UserDetailEntity::fromModel($user->detail) : null);
        $entity->setDepartment($user->departament !== null ? DepartamentEntity::fromModel($user->departament) : null);

        return $entity;
    }

    private static function normalizeDate(mixed $value): ?DateTimeInterface
    {
        if ($value instanceof DateTimeInterface) {
            return $value;
        }

        if (! is_string($value) || $value === '') {
            return null;
        }

        try {
            return new DateTimeImmutable($value);
        } catch (\Exception) {
            return null;
        }
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
            'created_at' => $this->getCreatedAt()?->format('Y-m-d H:i:s'),
            'updated_at' => $this->getUpdatedAt()?->format('Y-m-d H:i:s'),
            'detail' => $this->getDetail()?->toArray(),
            'department' => $this->getDepartment()?->toArray(),
        ];
    }
}
