<?php

namespace App\Containers\Order\Transformers;

use App\Containers\Order\Models\Order;
use App\Containers\User\Transformers\UserTransformer;
use App\Transformers\Transformer;

class OrderTransformer extends Transformer
{
    protected array $availableIncludes = [
        'user',
        'products'
    ];

    public function transform(Order $order): array
    {
        return [
            'id' => $order->getKey(),
            'status' => $order->getStatus(),
            'total_amount' => $order->getTotalPrice(),
            'created_at' => $order->getCreatedAt(),
            'updated_at' => $order->getUpdatedAt(),
        ];
    }

    public function includeUser(Order $order): \League\Fractal\Resource\Item
    {
        return $this->item($order->user, new UserTransformer());
    }

    public function includeProducts(Order $order): \League\Fractal\Resource\Collection
    {
        return $this->collection($order->products, new OrderProductTransformer());
    }
}
