<?php

namespace App\Containers\Product\Transformers;

use App\Containers\Product\Models\Product;
use App\Transformers\Transformer;

class ProductTransformer extends Transformer
{
    public function transform(Product $product): array
    {
        return [
            'id' => $product->getKey(),
            'name' => $product->getName(),
            'cost' => $product->getCost(),
            'description' => $product->getDescription(),
            'created_at' => $product->getCreatedAt(),
            'updated_at' => $product->getUpdatedAt(),
        ];
    }
}
