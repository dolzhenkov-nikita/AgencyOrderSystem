<?php

namespace App\Containers\Order\Actions;

use App\Containers\Order\Models\Order;
use App\Containers\Order\Tasks\CreateOrderProductsTask;
use App\Containers\Order\Tasks\SendOrderNotificationTask;
use App\Enums\StatusEnum;

class CreateOrderAction
{
    public function __construct(
        private CreateOrderProductsTask   $createOrderProductsTask,
        private SendOrderNotificationTask $sendOrderNotificationTask

    )
    {
    }

    public function run(array $orderData, int $userId): Order
    {
        // Создаем заказ
        $order = Order::create([
            'name' => "Заказ от " . now(),
            'user_id' => $userId,
            'status' => StatusEnum::NEW->value,
            'total_price' => 0,
        ]);

        // Создаем элементы заказа
        $totalAmount = $this->createOrderProductsTask->run($order, $orderData['products']);

        // Обновляем общую сумму
        $order->update(['total_price' => $totalAmount]);
        $this->sendOrderNotificationTask->execute($order);

        return $order->load('products.product');
    }
}
