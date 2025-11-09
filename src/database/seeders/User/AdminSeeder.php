<?php

namespace Database\Seeders\User;

use App\Containers\User\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminConfig = config('app.admin');

        if (User::where('email', $adminConfig['email'])
            ->where('role', 'admin')
            ->exists()) {
            $this->command->info("Администратор с email {$adminConfig['email']} уже существует.");
            return;
        }

        User::create([
            'name' => $adminConfig['name'],
            'email' => $adminConfig['email'],
            'password' => Hash::make($adminConfig['password']),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $this->command->info("✅ Администратор создан успешно!");
        $this->command->info("👤 Имя: {$adminConfig['name']}");
        $this->command->info("📧 Email: {$adminConfig['email']}");
    }
}
