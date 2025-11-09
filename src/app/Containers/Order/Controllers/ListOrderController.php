<?php

namespace App\Containers\Order\Controllers;

use App\Containers\Order\Models\Order;
use App\Containers\Order\Transformers\OrderTransformer;
use App\Http\Controllers\Controller;
use App\Services\FractalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListOrderController extends Controller
{
    public function __construct(
        private FractalService $fractal
    )
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $orders = Order::forCurrentUser()
            ->with(['products'])
            ->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 15));

        return response()->json([
            $this->fractal
                ->withIncludes(['products'])
                ->paginate($orders, new OrderTransformer(), 'orders')
        ]);
    }
}
