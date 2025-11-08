<?php

namespace App\Containers\Product\Controllers;

use App\Containers\Product\Actions\DeleteProductAction;
use App\Containers\Product\Models\Product;
use App\Http\Controllers\Controller;

class DeleteProductController extends Controller
{
    public function __construct(
        private DeleteProductAction $deleteProductAction
    )
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Product $product)
    {
        $this->deleteProductAction->run($product);
        return response()->json([
            'message' => 'Продукт успешно удален',
        ]);
    }
}
