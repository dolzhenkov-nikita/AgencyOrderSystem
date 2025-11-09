<?php

namespace App\Containers\Order\Controllers;

use App\Containers\Order\Actions\UpdateOrderStatusAction;
use App\Containers\Order\Models\Order;
use App\Containers\Order\Requests\UpdateOrderStatusRequest;
use App\Containers\Order\Transformers\OrderTransformer;
use App\Http\Controllers\Controller;
use App\Services\FractalService;

class UpdateOrderStatusController extends Controller
{
    public function __construct(
        Private FractalService $fractal,
        private UpdateOrderStatusAction $action
    ) {}
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateOrderStatusRequest $request, Order $order)
    {
        $order = $this->action->run($order, $request->status);

            return response()->json(
                $this->fractal->item($order,new OrderTransformer())
            );

    }
}
