<?php

namespace App\Containers\Product\Controllers;

use App\Containers\Product\Actions\CreateProductAction;
use App\Containers\Product\Models\Product;
use App\Containers\Product\Requests\CreateProductRequest;
use App\Http\Controllers\Controller;

class CreateProductController extends Controller
{
    public function __construct(
        private CreateProductAction $createProductAction
    ) {}
    public function __Invoke(CreateProductRequest $request)
    {
        $product = $this->createProductAction->run($request->validated());

        return response()->json([
            "product" => $product,
        ], 200);
    }
}
