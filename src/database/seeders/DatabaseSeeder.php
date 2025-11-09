<?php

namespace Database\Seeders;

use App\Containers\User\Models\User;
use Database\Seeders\Order\OrderSeeder;
use Database\Seeders\Product\ProductSeeder;
use Database\Seeders\User\AdminSeeder;
use Database\Seeders\User\UserSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            ProductSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
