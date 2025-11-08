<?php

namespace App\Containers\Order\Controllers;

use App\Containers\Order\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $orders = Order::forCurrentUser()
            ->with(['products.product'])
            ->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 15));

        return response()->json([
            'orders' => $orders,
        ]);
    }
}
