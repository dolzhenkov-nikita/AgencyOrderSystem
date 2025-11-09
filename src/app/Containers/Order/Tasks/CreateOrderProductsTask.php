<?php
namespace App\Containers\Order\Tasks;

use App\Containers\Order\Models\Order;
use App\Containers\Product\Models\Product;

class CreateOrderProductsTask
{
    public function run(Order $order, array $productsData)
    {
        $totalAmount = 0;
        $productIds = collect($productsData)->pluck('product_id');
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        foreach ($productsData as $productData) {
            $product = $products[$productData['product_id']];
            $quantity = $productData['quantity'];
            $itemTotal = $product->getCost() * $quantity;

            $order->products()->attach($product->getKey(),[
                'quantity' => $quantity,
                'total_price' => $itemTotal,
            ]);

            $totalAmount += $itemTotal;
        }

        return $totalAmount;
    }
}
