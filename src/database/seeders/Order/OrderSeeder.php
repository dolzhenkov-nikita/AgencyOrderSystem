<?php

namespace Database\Seeders\Order;

use App\Containers\Order\Models\Order;
use App\Containers\Product\Models\Product;
use App\Containers\User\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Order::count() > 0) {
            $this->command->info('Таблица orders не пустая. OrderSeeder пропускается.');
            return;
        }

        $faker = \Faker\Factory::create('ru_RU');

        $users = User::where('id', '!=', 1)->get();
        if ($users->count() < 2) {
            $this->command->error('Недостаточно обычных пользователей для создания заказов. Сначала запустите UserSeeder.');
            return;
        }

        $products = Product::all();
        if ($products->count() < 5) {
            $this->command->error('Недостаточно продуктов для создания заказов. Сначала запустите ProductSeeder.');
            return;
        }

        $firstOrderProducts = $products->take(2);
        $firstOrderTotal = $firstOrderProducts->sum('cost') ?? 0;

        $firstOrder = Order::create([
            'name' => $faker->words(3, true),
            'description' => $faker->sentence(8),
            'status' => $faker->randomElement(['new', 'processing', 'completed']),
            'user_id' => $users[0]->id,
            'total_price' => $firstOrderTotal,
        ]);

        foreach ($firstOrderProducts as $product) {
            $quantity = $faker->numberBetween(1, 3);
            $totalPrice = ($product->cost ?? 0) * $quantity;

            $firstOrder->products()->attach($product->id, [
                'quantity' => $quantity,
                'total_price' => $totalPrice,
            ]);
        }

        $secondOrderProducts = $products->slice(2, 3);
        $secondOrderTotal = $secondOrderProducts->sum('cost') ?? 0;

        $secondOrder = Order::create([
            'name' => $faker->words(3, true),
            'description' => $faker->sentence(8),
            'status' => $faker->randomElement(['new', 'processing', 'completed']),
            'user_id' => $users[1]->id,
            'total_price' => $secondOrderTotal,
        ]);

        foreach ($secondOrderProducts as $product) {
            $quantity = $faker->numberBetween(1, 3);
            $totalPrice = ($product->cost ?? 0) * $quantity;

            $secondOrder->products()->attach($product->id, [
                'quantity' => $quantity,
                'total_price' => $totalPrice,
            ]);
        }

        $this->command->info("✅ Создано 2 заказа:");
        $this->command->info("   - Заказ 1: пользователь '{$users[0]->name}', 2 продукта, сумма: {$firstOrderTotal}₽");
        $this->command->info("   - Заказ 2: пользователь '{$users[1]->name}', 3 продукта, сумма: {$secondOrderTotal}₽");
    }
}
