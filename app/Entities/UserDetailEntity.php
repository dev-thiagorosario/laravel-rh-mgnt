<?php

declare(strict_types=1);

namespace App\Entities;

use App\Models\UserDetail;
use DateTimeInterface;

class UserDetailEntity
{
    protected ?int $id = null;
    protected ?string $address = null;
    protected ?string $zip_code = null;
    protected ?string $city = null;
    protected ?string $phone = null;
    protected ?string $salary = null;
    protected ?string $admission_date = null;
    protected ?int $user_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zip_code;
    }

    public function setZipCode(?string $zip_code): self
    {
        $this->zip_code = $zip_code;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    public function getSalary(): ?string
    {
        return $this->salary;
    }

    public function setSalary(?string $salary): self
    {
        $this->salary = $salary;
        return $this;
    }

    public function getAdmissionDate(): ?string
    {
        return $this->admission_date;
    }

    public function setAdmissionDate(?string $admission_date): self
    {
        $this->admission_date = $admission_date;
        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(?int $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    public static function fromModel(UserDetail $userDetail): self
    {
        $admissionDate = $userDetail->admission_date;

        $entity = new self();
        $entity->setId($userDetail->id);
        $entity->setAddress($userDetail->address);
        $entity->setZipCode($userDetail->zip_code);
        $entity->setCity($userDetail->city);
        $entity->setPhone($userDetail->phone);
        $entity->setSalary((string) $userDetail->salary);
        $entity->setAdmissionDate($admissionDate instanceof DateTimeInterface ? $admissionDate->format('Y-m-d') : (is_string($admissionDate) ? $admissionDate : null));
        $entity->setUserId($userDetail->user_id);

        return $entity;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'user_id' => $this->getUserId(),
            'address' => $this->getAddress(),
            'zip_code' => $this->getZipCode(),
            'city' => $this->getCity(),
            'phone' => $this->getPhone(),
            'salary' => $this->getSalary(),
            'admission_date' => $this->getAdmissionDate(),
        ];
    }
}
