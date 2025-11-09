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
        if (auth()->user()->isAdmin()) {
            $this->deleteProductAction->run($product);
            return response()->json([
                'message' => 'Продукт успешно удален',
            ]);
        }

        return response()->json([
            "message" => "Недостаточно прав для удаления продукта"
        ], 403);
    }
}
