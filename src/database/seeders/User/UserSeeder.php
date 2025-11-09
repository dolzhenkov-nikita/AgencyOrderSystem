<?php

namespace Database\Seeders\User;

use App\Containers\User\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::where('role', '!=', 'admin')->count() > 0) {
            $this->command->info('В таблице users уже есть обычные пользователи. UserSeeder пропускается.');
            return;
        }

        $users = [
            [
                'name' => 'Иван Иванов',
                'email' => 'ivan@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Мария Петрова',
                'email' => 'maria@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }

        $this->command->info("✅ Создано " . count($users) . " обычных пользователей");
    }
}
