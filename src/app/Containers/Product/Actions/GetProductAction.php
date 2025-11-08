<?php
namespace App\Containers\Product\Actions;
use App\Containers\Product\Models\Product;

class GetProductAction
{
    public function run(Product $product): Product
    {
        return $product;
    }
}
