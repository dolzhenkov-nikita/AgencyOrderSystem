<?php

namespace App\Containers\Order\Actions;

use App\Containers\Order\Models\Order;
use App\Containers\Order\Tasks\CreateOrderProductsTask;
use App\Containers\Order\Tasks\SendOrderNotificationTask;
use App\Enums\StatusEnum;

class GetOrderAction
{
    public function __construct(
    )
    {
    }

    public function run(Order $order): Order
    {
        return $order->load(['products', 'user']);
    }
}
