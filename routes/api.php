<?php

use App\Http\Controllers\ItemSaleController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// Adding prefix the all routes of group
Route::prefix('v1')->group(function () {
    // Adding prefix the all routes of group
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/{id}', [ProductController::class, 'show']);
        Route::post('/', [ProductController::class, 'store']);
        Route::patch('revert_delete', [ProductController::class, 'revertDelete']);
        Route::patch('{product}', [ProductController::class, 'update']);
        Route::delete('force_destroy/{product}', [ProductController::class, 'forceDestroy']);
        Route::delete('{product}', [ProductController::class, 'destroy']);
    });
    // Simplified register of route using the method "apiResource" of class "Route"
    Route::apiResource(
        'items_sale',
        ItemSaleController::class,
    )
        // Modify the name of parameter injected in request
        ->parameters(['items_sale' => 'itemSale']);
});