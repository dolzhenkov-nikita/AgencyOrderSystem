<?php

namespace App\Containers\Order\Controllers;

use App\Containers\Order\Actions\ListOrderAction;
use App\Containers\Order\Models\Order;
use App\Containers\Order\Requests\ListOrderRequest;
use App\Containers\Order\Transformers\OrderTransformer;
use App\Http\Controllers\Controller;
use App\Services\FractalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListOrderController extends Controller
{
    public function __construct(
        private FractalService $fractal,
        private ListOrderAction $action
    )
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(ListOrderRequest $request): JsonResponse
    {
        $orders = $this->action->run($request);

        return response()->json([
            $this->fractal
                ->withIncludes(['products'])
                ->paginate($orders, new OrderTransformer(), 'orders')
        ]);
    }
}
