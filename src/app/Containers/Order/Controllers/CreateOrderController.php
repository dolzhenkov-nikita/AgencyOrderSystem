<?php

namespace App\Containers\Order\Controllers;

use App\Containers\Order\Actions\CreateOrderAction;
use App\Containers\Order\Requests\CreateOrderRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class CreateOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __construct(
        private readonly CreateOrderAction $createOrderAction
    ) {}

    public function __invoke(CreateOrderRequest $request): JsonResponse
    {
        $order = $this->createOrderAction->run(
            $request->validated(),
            auth()->id()
        );

        return response()->json([
            'message' => 'Заказ успешно создан',
            'order' => $order,
        ], 201);
    }
}
