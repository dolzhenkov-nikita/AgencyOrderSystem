<?php

namespace App\Containers\Order\Controllers;

use App\Containers\Order\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Order $order): JsonResponse
    {
        // Проверяем, что заказ принадлежит текущему пользователю
        if ($order->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'Заказ не найден',
            ], 404);
        }

        $order->load(['products.product', 'user']);

        return response()->json([
            'order' => $order,
        ]);
    }
}
