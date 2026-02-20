<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    public function run(): void
    {
        $departaments = DB::table('departaments')
            ->select(['id', 'name'])
            ->orderBy('id')
            ->get();

        if ($departaments->isEmpty()) {
            throw new \RuntimeException(
                'Nenhum departament encontrado. Rode o seeder de Departaments antes de UserTableSeeder.'
            );
        }

        foreach ($departaments as $index => $departament) {
            $departamentId = (int) $departament->id;
            $departamentName = (string) $departament->name;
            $departamentSlug = Str::slug($departamentName, '.');

            $adminEmail = $index === 0
                ? 'admin@example.com'
                : "admin.{$departamentSlug}.{$departamentId}@example.com";

            User::query()
                ->withTrashed()
                ->updateOrCreate(
                    ['email' => $adminEmail],
                    [
                        'name' => "Admin {$departamentName}",
                        'departament_id' => $departamentId,
                        'password' => 'aaa123',
                        'role' => 'admin',
                        'permissions' => 'all',
                        'deleted_at' => null,
                    ]
                );

            User::query()
                ->withTrashed()
                ->updateOrCreate(
                    ['email' => "manager.{$departamentSlug}.{$departamentId}@example.com"],
                    [
                        'name' => "Manager {$departamentName}",
                        'departament_id' => $departamentId,
                        'password' => 'aaa123',
                        'role' => 'manager',
                        'permissions' => 'write',
                        'deleted_at' => null,
                    ]
                );

            for ($employeeNumber = 1; $employeeNumber <= 3; $employeeNumber++) {
                User::query()
                    ->withTrashed()
                    ->updateOrCreate(
                        ['email' => "employee{$employeeNumber}.{$departamentSlug}.{$departamentId}@example.com"],
                        [
                            'name' => "Employee {$employeeNumber} {$departamentName}",
                            'departament_id' => $departamentId,
                            'password' => 'aaa123',
                            'role' => 'employee',
                            'permissions' => '',
                            'deleted_at' => null,
                        ]
                    );
            }
        }
    }
}
