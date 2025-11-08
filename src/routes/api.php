<?php

use App\Containers\Order\Controllers\CreateOrderController;
use App\Containers\Order\Controllers\GetOrderController;
use App\Containers\Order\Controllers\ListOrderController;
use App\Containers\Order\Controllers\UpdateOrderStatusController;
use App\Containers\Product\Controllers\CreateProductController;
use App\Containers\Product\Controllers\UpdateProductController;
use App\Containers\User\Controllers\Auth\LoginController;
use App\Containers\User\Controllers\Auth\LogoutController;
use App\Containers\User\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', RegisterController::class);
Route::post('/login', LoginController::class);

Route::middleware("auth:sanctum")->group(function () {
    Route::post("/logout", LogoutController::class);

    Route::post("/products", CreateProductController::class);
    Route::put("/products/{product}", UpdateProductController::class);

    Route::post("/orders", CreateOrderController::class);
    Route::get("/orders", ListOrderController::class);
    Route::patch("/orders/{order}/status", UpdateOrderStatusController::class);
    Route::get("/orders/{order}", GetOrderController::class);
});
