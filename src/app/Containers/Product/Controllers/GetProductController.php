<?php

namespace App\Containers\Product\Controllers;

use App\Containers\Product\Actions\GetProductAction;
use App\Containers\Product\Models\Product;
use App\Http\Controllers\Controller;

class GetProductController extends Controller
{
    public function __construct(
        private GetProductAction $getProductAction
    )
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Product $product)
    {
        $product = $this->getProductAction->run($product);

        return response()->json([
            'product' => $product,
        ]);
    }
}
