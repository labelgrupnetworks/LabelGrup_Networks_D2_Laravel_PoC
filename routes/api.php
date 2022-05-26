<?php


use App\Api\Auth\Controllers\AuthController;
use App\Api\Categories\Controllers\CategoryController;
use App\Api\Products\Controllers\ProductCategoryController;
use App\Api\Products\Controllers\ProductController;
use App\Api\Users\Controllers\UserController;
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

Route::post('register', [AuthController::class, 'register'])->name('api.auth.register');
Route::post('login', [AuthController::class, 'login'])->name('api.auth.login');

Route::middleware('auth:sanctum')->group(function (){
    Route::get('logout', [AuthController::class, 'logout'])->name('api.auth.logout');
    Route::apiResource('products', ProductController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('users', UserController::class);

    Route::get('product-categories/{product}/categories', [ProductCategoryController::class, 'index'])
        ->name('api.product-categories.index');

    Route::post('product-categories/{product}/create', [ProductCategoryController::class, 'store'])
        ->name('api.create-product-categories.index');

    Route::patch('product-categories/{product}/update', [ProductCategoryController::class, 'update'])
        ->name('api.update-product-categories.index');

    Route::delete('product-categories/{product}/destroy', [ProductCategoryController::class, 'destroy'])
        ->name('api.destroy-product-categories.index');
});
