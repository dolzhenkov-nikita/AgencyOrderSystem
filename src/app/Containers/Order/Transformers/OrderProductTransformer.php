<?php

namespace App\Containers\Order\Transformers;

use App\Containers\Order\Models\OrderProduct;
use App\Containers\Product\Transformers\ProductTransformer;
use App\Transformers\Transformer;

class OrderProductTransformer extends Transformer
{
    protected array $availableIncludes = [
        'product'
    ];

    public function transform(OrderProduct $orderProduct): array
    {
        return [
            'id' => $orderProduct->getKey(),
            'quantity' => $orderProduct->getQuantity(),
            'total_price' => $orderProduct->getTotalPrice(),
        ];
    }

    public function includeProduct(OrderProduct $orderProduct): \League\Fractal\Resource\Item
    {
        return $this->item($orderProduct->product, new ProductTransformer());
    }
}
