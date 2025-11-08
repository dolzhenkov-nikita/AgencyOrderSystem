<?php

namespace App\Containers\Order\Tasks;

use App\Containers\Order\Models\Order;
use App\Containers\User\Models\User;
use App\Notifications\OrderCreatedNotification;

class SendOrderNotificationTask
{
    public function execute(Order $order): void
    {
        $user = User::find($order->user_id);

        if ($user) {
            $user->notify(new OrderCreatedNotification($order));
        }
    }
}
