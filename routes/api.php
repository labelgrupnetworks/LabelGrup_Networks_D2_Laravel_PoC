<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;

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
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    // Categories
    Route::get('categories', [CategoryController::class, 'find']);
    Route::get('get-category', [CategoryController::class, 'findOne']);
    Route::post('new-category', [CategoryController::class, 'create']);
    Route::post('edit-category', [CategoryController::class, 'edit']);
    Route::post('delete-category', [CategoryController::class, 'delete']);

    // Products
    Route::get('products', [ProductController::class, 'find']);
    Route::get('get-product', [ProductController::class, 'findOne']);
    Route::post('new-product', [ProductController::class, 'store']);
    Route::post('edit-product', [ProductController::class, 'edit']);
    Route::post('delete-product', [ProductController::class, 'delete']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});