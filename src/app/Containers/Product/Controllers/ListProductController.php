<?php

namespace App\Containers\Product\Controllers;

use App\Containers\Product\Actions\ListProductsAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListProductController extends Controller
{
    public function __construct(
        private readonly ListProductsAction $listProductsAction
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
            'products' => $products,
        ]);
    }
}
