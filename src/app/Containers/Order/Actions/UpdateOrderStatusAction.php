<?php

namespace App\Containers\Order\Actions;

use App\Containers\Order\Models\Order;
use App\Containers\Order\Requests\ListOrderRequest;
use App\Containers\Order\Tasks\CreateOrderProductsTask;
use App\Containers\Order\Tasks\SendOrderNotificationTask;
use App\Containers\Order\Tasks\UpdateOrderStatusTask;
use App\Enums\StatusEnum;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class UpdateOrderStatusAction
{
    public function __construct(
        private UpdateOrderStatusTask $updateOrderStatusTask

    )
    {
    }

    /**
     * @throws \Exception
     */
    public function run(Order $order, string $status): Order
    {
        try {
            return $this->updateOrderStatusTask->run($order, $status);
        } catch (\Exception $e) {
            Log::error('Order status update failed', [
                'order_id' => $order->id,
                'status' => $status,
                'error' => $e->getMessage()
            ]);

            throw $e;
        }
    }
}
