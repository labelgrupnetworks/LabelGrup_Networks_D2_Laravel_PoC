<?php


use App\Api\Auth\Controllers\AuthController;
use App\Api\Categories\Controllers\CategoryController;
use App\Api\Products\Controllers\CategoryMainController;
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
        ->name('api.product-categories.create');

    Route::patch('product-categories/{product}/update', [ProductCategoryController::class, 'update'])
        ->name('api.product-categories.update');

    Route::delete('product-categories/{product}/destroy', [ProductCategoryController::class, 'destroy'])
        ->name('api.-product-categories.destroy');


    Route::post('category-main/{product}', CategoryMainController::class)->name('api.category-main');
});
