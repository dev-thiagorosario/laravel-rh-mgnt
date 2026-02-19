<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    public function run(): void
    {
        $departamentId = DB::table('departaments')->value('id');

        if (!$departamentId) {
            throw new \RuntimeException(
                'Nenhum departament encontrado. Rode o seeder de Departaments antes de UserTableSeeder.'
            );
        }

        User::factory()
            ->withDepartamentId((int) $departamentId)
            ->withRole('admin')
            ->withPermissions('all')
            ->withPassword('aaa123')
            ->create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
            ]);

        User::factory(10)
            ->withDepartamentId((int) $departamentId)
            ->withRole('manager')
            ->withPassword('aaa123')
            ->withPermissions('write')
            ->create();

        User::factory(20)
            ->withDepartamentId((int) $departamentId)
            ->withRole('employee')
            ->withPassword('aaa123')
            ->withPermissions('')
            ->create();
    }
}
