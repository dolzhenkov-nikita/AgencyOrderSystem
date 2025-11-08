<?php
namespace App\Containers\Product\Actions;
use App\Containers\Product\Models\Product;

class UpdateProductAction
{
    public function run(Product $product, array $data):Product
    {
        $product->update($data);
        return $product->fresh();
    }
}
