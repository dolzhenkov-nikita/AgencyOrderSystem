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

        $syncData = [];

        foreach ($productsData as $productData) {
            $product = $products[$productData['product_id']];
            $quantity = $productData['quantity'];
            $itemTotal = $product->getCost() * $quantity;

            $syncData[$product->getKey()] = [
                'quantity' => $quantity,
                'total_price' => $itemTotal,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $totalAmount += $itemTotal;
        }

        $order->products()->sync($syncData);

        return $totalAmount;
    }
}
