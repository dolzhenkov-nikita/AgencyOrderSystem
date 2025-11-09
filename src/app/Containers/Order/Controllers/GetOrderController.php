<?php

namespace App\Containers\Order\Controllers;

use App\Containers\Order\Actions\GetOrderAction;
use App\Containers\Order\Models\Order;
use App\Containers\Order\Requests\GetOrderRequest;
use App\Containers\Order\Transformers\OrderTransformer;
use App\Http\Controllers\Controller;
use App\Services\FractalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetOrderController extends Controller
{
    public function __construct(
        private FractalService $fractal,
        private GetOrderAction $action
    )
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(GetOrderRequest $request, Order $order): JsonResponse
    {
        $order = $this->action->run($order);

        return response()->json(
            $this->fractal
                ->withIncludes(['products'])
                ->item($order, new OrderTransformer())
        );
    }
}
