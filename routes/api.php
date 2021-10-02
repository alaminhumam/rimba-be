<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\DiscountController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\SalesController;
use App\Http\Controllers\Api\UnitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->as('v1.')->group(function () {
    Route::apiResource('units', UnitController::class);
    Route::apiResource('items', ItemController::class);
    Route::apiResource('discounts', DiscountController::class);
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('sales', SalesController::class);
});
