<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => $this->faker->randomElement(['admin', 'manager', 'employee']),
            'permissions' => $this->faker->randomElement(['all', 'read', 'write']),
        ];
    }

    public function withPassword(string $password): self
    {
        static::$password = $password;
        return $this;
    }

    public function withRole(string $role): self
    {
        return $this->state(['role' => $role]);
    }

    public function withPermissions(string $permissions): self
    {
        return $this->state(['permissions' => $permissions]);
    }

    public function withDepartamentId(int $departamentId): self
    {
        return $this->state(['departament_id' => $departamentId]);
    }
}
