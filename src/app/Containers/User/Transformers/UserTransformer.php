<?php

namespace App\Containers\User\Transformers;

use App\Containers\Order\Transformers\OrderTransformer;
use App\Containers\User\Models\User;
use App\Transformers\Transformer;

class UserTransformer extends Transformer
{
    protected array $availableIncludes = [
        'orders'
    ];

    public function transform(User $user): array
    {
        return [
            'id' => $user->getKey(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'role' => $user->getRole(),
        ];
    }

    public function includeOrders(User $user): \League\Fractal\Resource\Collection
    {
        $orders = $user->orders;
        return $this->collection($orders, new OrderTransformer());
    }
}
