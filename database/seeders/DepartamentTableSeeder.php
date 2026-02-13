<?php

namespace Database\Seeders;

use App\Models\Departament;
use Illuminate\Database\Seeder;

class DepartamentTableSeeder extends Seeder
{
    public function run(): void
    {
        $departaments = [
            'Recursos Humanos',
            'Financeiro',
            'Tecnologia',
            'Comercial',
            'Operacoes',
        ];

        foreach ($departaments as $name) {
            Departament::query()->firstOrCreate(['name' => $name]);
        }
    }
}
