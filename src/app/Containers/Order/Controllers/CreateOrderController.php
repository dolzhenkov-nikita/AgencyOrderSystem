<?php

namespace App\Containers\Order\Controllers;

use App\Containers\Order\Actions\CreateOrderAction;
use App\Containers\Order\Requests\CreateOrderRequest;
use App\Containers\Order\Transformers\OrderTransformer;
use App\Http\Controllers\Controller;
use App\Services\FractalService;
use Illuminate\Http\JsonResponse;

class CreateOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __construct(
        private readonly CreateOrderAction $createOrderAction,
        private FractalService             $fractal
    )
    {
    }

    public function __invoke(CreateOrderRequest $request): JsonResponse
    {
        $order = $this->createOrderAction->run(
            $request->validated(),
            auth()->id()
        );

        return response()->json([
            $this->fractal->item($order, new OrderTransformer(), 'orders')
        ], 201);
    }
}
