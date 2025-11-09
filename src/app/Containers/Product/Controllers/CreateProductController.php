<?php

namespace App\Containers\Product\Controllers;

use App\Containers\Product\Actions\CreateProductAction;
use App\Containers\Product\Requests\CreateProductRequest;
use App\Containers\Product\Transformers\ProductTransformer;
use App\Http\Controllers\Controller;
use App\Services\FractalService;
use Illuminate\Http\JsonResponse;

class CreateProductController extends Controller
{
    public function __construct(
        private CreateProductAction $createProductAction,
        private FractalService      $fractal
    )
    {
    }

    public function __Invoke(CreateProductRequest $request): JsonResponse
    {
        $product = $this->createProductAction->run($request->validated());

        return response()->json(
            $this->fractal->item($product, new ProductTransformer(), 'product')
            , 201);
    }
}
