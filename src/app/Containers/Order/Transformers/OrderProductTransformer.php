<?php

namespace App\Containers\Order\Transformers;

use App\Containers\Order\Models\OrderProduct;
use App\Containers\Product\Models\Product;
use App\Containers\Product\Transformers\ProductTransformer;
use App\Transformers\Transformer;

class OrderProductTransformer extends Transformer
{
    protected array $availableIncludes = [
        'product'
    ];

    public function transform(Product $product): array
    {
        return [
            'id' => $product->getKey(),
            'name' => $product->getName(),
            'cost' => $product->getCost(),
            'description' => $product->getDescription(),
            'quantity' => $product->pivot->quantity,
            'item_total' => $product->pivot->total_price,
        ];
    }
}
