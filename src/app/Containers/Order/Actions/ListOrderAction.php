<?php

namespace App\Containers\Order\Actions;

use App\Containers\Order\Models\Order;
use App\Containers\Order\Requests\ListOrderRequest;
use App\Containers\Order\Tasks\CreateOrderProductsTask;
use App\Containers\Order\Tasks\SendOrderNotificationTask;
use App\Enums\StatusEnum;
use Illuminate\Pagination\LengthAwarePaginator;

class ListOrderAction
{
    public function __construct(
    )
    {
    }

    public function run(ListOrderRequest $request): LengthAwarePaginator
    {
        return Order::forCurrentUser()
            ->with(['products'])
            ->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 15));
    }
}
