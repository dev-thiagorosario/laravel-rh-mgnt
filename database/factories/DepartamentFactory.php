<?php

namespace Database\Factories;

use App\Models\Departament;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartamentFactory extends Factory
{
    protected $model = Departament::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Recursos Humanos',
                'Financeiro',
                'Tecnologia',
                'Comercial',
                'Operacoes',
                'Juridico',
            ]),
        ];
    }

    public function withName(string $name): self
    {
        return $this->state(['name' => $name]);
    }
}
