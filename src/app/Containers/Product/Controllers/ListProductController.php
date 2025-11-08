<?php

namespace App\Containers\Product\Controllers;

use App\Containers\Product\Actions\ListProductsAction;
use App\Containers\Product\Transformers\ProductTransformer;
use App\Http\Controllers\Controller;
use App\Services\FractalService;
use Illuminate\Http\Request;

class ListProductController extends Controller
{
    public function __construct(
        private readonly ListProductsAction $listProductsAction,
        private FractalService              $fractal
    )
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = $this->listProductsAction->run($request->all());
        return response()->json([
            $this->fractal->paginate($products, new ProductTransformer(), 'products'),
        ]);
    }
}
