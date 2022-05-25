<?php


use App\Api\Auth\Controllers\AuthController;
use App\Api\Categories\Controllers\CategoriesController;
use App\Api\Products\Controllers\ProductsController;
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
    Route::apiResource('products', ProductsController::class);
    Route::apiResource('categories', CategoriesController::class);
});
