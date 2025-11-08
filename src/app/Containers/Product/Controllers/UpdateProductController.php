<?php

namespace App\Containers\Product\Controllers;

use App\Containers\Product\Actions\UpdateProductAction;
use App\Containers\Product\Models\Product;
use App\Containers\Product\Requests\UpdateProductRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class UpdateProductController extends Controller
{
    public function __construct(
        private UpdateProductAction $updateProductAction
    ) {}
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $updatedProduct = $this->updateProductAction->run($product, $request->validated());

        return response()->json([
            "message" => "Продукт успешно обновлен",
            "product" => $updatedProduct,
        ]);
    }
}
