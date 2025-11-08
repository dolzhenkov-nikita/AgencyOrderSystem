<?php

namespace App\Containers\Product\Controllers;

use App\Containers\Product\Actions\GetProductAction;
use App\Containers\Product\Models\Product;
use App\Containers\Product\Transformers\ProductTransformer;
use App\Http\Controllers\Controller;
use App\Services\FractalService;

class GetProductController extends Controller
{
    public function __construct(
        private GetProductAction $getProductAction,
        private FractalService   $fractal

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
            $this->fractal->item($product, new ProductTransformer(), 'product')
        ]);
    }
}
