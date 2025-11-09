<?php
namespace App\Containers\Product\Actions;
use App\Containers\Product\Models\Product;

class CreateProductAction
{
    public function run(array $data):Product
    {
        return Product::create($data);
    }
}
