<?php

namespace App\Containers\Product\Actions;

use App\Containers\Product\Models\Product;

class DeleteProductAction
{
    public function run(Product $product): bool
    {
        return $product->delete();
    }
}
