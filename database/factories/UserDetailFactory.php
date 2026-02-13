<?php

namespace Database\Factories;

use App\Models\UserDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserDetailFactory extends Factory
{
    protected $model = UserDetail::class;

    public function definition(): array
    {
        return [
            'address' => $this->faker->streetAddress(),
            'zip_code' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'phone' => $this->faker->numerify('###########'),
            'salary' => $this->faker->randomFloat(2, 1412.00, 28000.00),
            'admission_date' => $this->faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d'),
        ];
    }

    public function withUserId(int $userId): self
    {
        return $this->state(['user_id' => $userId]);
    }
}
