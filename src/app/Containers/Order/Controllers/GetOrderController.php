<?php

namespace App\Containers\Order\Controllers;

use App\Containers\Order\Models\Order;
use App\Containers\Order\Transformers\OrderTransformer;
use App\Http\Controllers\Controller;
use App\Services\FractalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetOrderController extends Controller
{
    public function __construct(
        private FractalService $fractal
    )
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Order $order): JsonResponse
    {
        if ($order->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'Заказ не найден',
            ], 404);
        }

        $order->load(['products', 'user']);

        return response()->json(
            $this->fractal
                ->withIncludes(['products'])
                ->item($order, new OrderTransformer())
        );
    }
}
