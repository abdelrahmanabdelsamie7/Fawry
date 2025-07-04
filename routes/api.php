<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{
    ProductController,
    CustomerController,
    CartController,
    CartItemController,
    OrderController
};
Route::prefix('v1')->group(function () {
    Route::apiResources([
        'product' => ProductController::class,
        'customer' => CustomerController::class,
        'cart' => CartController::class,
        'cart-item' => CartItemController::class,
    ]);

    Route::post('cart/clear/{customerId}', [CartItemController::class, 'clear']);
    Route::post('checkout/{customerId}', [OrderController::class, 'checkout']);
});
