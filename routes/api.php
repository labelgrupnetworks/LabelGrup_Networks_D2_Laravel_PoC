<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ImageController;

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
Route::get('logout', [UserController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware(['role:admin|mod|comercial'])->group(function () {
        Route::get('categories', [CategoryController::class, 'find']);
        Route::get('products', [ProductController::class, 'find']);
        Route::get('images', [ImageController::class, 'find']);

        Route::get('get-category', [CategoryController::class, 'findOne']);
        Route::get('get-product', [ProductController::class, 'findOne']);
        Route::get('get-images-product', [ImageController::class, 'findByIdProduct']);
    });

    Route::middleware(['role:admin|mod'])->group(function () {
        Route::get('users', [UserController::class, 'find']);

        Route::post('new-category', [CategoryController::class, 'store']);
        Route::post('edit-category', [CategoryController::class, 'update']);
        
        Route::post('new-product', [ProductController::class, 'store']);
        Route::post('edit-product', [ProductController::class, 'update']);

        Route::post('new-image', [ImageController::class, 'store']);
        Route::post('edit-image', [ImageController::class, 'update']);
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::post('edit-user', [UserController::class, 'update']);

        Route::post('delete-category', [CategoryController::class, 'delete']);
        Route::post('delete-product', [ProductController::class, 'delete']);
        Route::post('delete-image', [ImageController::class, 'delete']);
    });
    
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});