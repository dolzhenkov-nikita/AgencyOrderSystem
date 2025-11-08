<?php

namespace App\Containers\Order\Controllers;

use App\Containers\Order\Models\Order;
use App\Containers\Order\Requests\UpdateOrderStatusRequest;
use App\Http\Controllers\Controller;

class UpdateOrderStatusController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateOrderStatusRequest $request, Order $order)
    {
        try {
            $order->update([
                'status' => $request->status,
            ]);

            return response()->json([
                'message' => 'Статус заказа обновлен',
                'order' => $order->fresh(),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ошибка при обновлении статуса',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
