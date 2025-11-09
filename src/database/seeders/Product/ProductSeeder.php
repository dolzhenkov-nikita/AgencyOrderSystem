<?php

namespace Database\Seeders\Product;

use App\Containers\Product\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Product::count() > 0) {
            $this->command->info('Таблица products не пустая. ProductSeeder пропускается.');
            return;
        }

        $faker = \Faker\Factory::create('ru_RU');

        $products = [
            [
                'name' => $faker->words(3, true),
                'description' => $faker->sentence(10),
                'cost' => $faker->numberBetween(1000, 100000),
            ],
            [
                'name' => $faker->words(4, true),
                'description' => $faker->sentence(12),
                'cost' => $faker->numberBetween(500, 50000),
            ],
            [
                'name' => $faker->words(2, true),
                'description' => $faker->sentence(8),
                'cost' => $faker->numberBetween(2000, 80000),
            ],
            [
                'name' => $faker->words(3, true),
                'description' => $faker->sentence(15),
                'cost' => null,
            ],
            [
                'name' => $faker->words(5, true),
                'description' => $faker->sentence(6),
                'cost' => $faker->numberBetween(500, 10000),
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }

        $this->command->info("✅ Создано " . count($products) . " продуктов со случайными названиями и описаниями");
    }
}
