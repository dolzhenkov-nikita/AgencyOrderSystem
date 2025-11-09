<?php

namespace App\Containers\Order\Tasks;

use App\Containers\Order\Models\Order;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateOrderStatusTask
{

    public function run(Order $order, string $status): Order
    {
        $order->update(['status' => $status]);

        return $order->fresh();
    }
}
