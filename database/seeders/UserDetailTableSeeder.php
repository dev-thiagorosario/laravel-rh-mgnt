<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Database\Seeder;

class UserDetailTableSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::query()->pluck('id');

        if ($userIds->isEmpty()) {
            throw new \RuntimeException(
                'Nenhum user encontrado. Rode o UserTableSeeder antes de UserDetailTableSeeder.'
            );
        }

        foreach ($userIds as $userId) {
            UserDetail::factory()
                ->withUserId((int) $userId)
                ->create();
        }
    }
}
