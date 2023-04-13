<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
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

Route::post('login', [AuthController::class, 'login'])->name('api.auth.login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('api.auth.logout');

    Route::middleware(['role:administrator|moderator|commercial'])->group(function () {
        Route::get('products', [ProductController::class, 'index'])->name('api.products.index');
        Route::get('categories', [CategoryController::class, 'index'])->name('api.categories.index');
        Route::get('images', [ImageController::class, 'index'])->name('api.images.index');
    });

    Route::middleware(['role:administrator|moderator'])->group(function () {
        Route::post('products', [ProductController::class, 'store'])->name('api.products.store');
        Route::get('products/{id}', [ProductController::class, 'show'])->name('api.products.show');
        Route::put('products/{id}', [ProductController::class, 'update'])->name('api.products.update');

        Route::post('categories', [CategoryController::class, 'store'])->name('api.categories.store');
        Route::get('categories/{id}', [CategoryController::class, 'show'])->name('api.categories.show');
        Route::put('categories/{id}', [CategoryController::class, 'update'])->name('api.categories.update');

        Route::get('images/{id}', [ImageController::class, 'show'])->name('api.images.show');
    });

    Route::middleware(['role:administrator'])->group(function () {
        Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('api.products.destroy');
        Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('api.categories.destroy');
        Route::delete('images/{id}', [ImageController::class, 'destroy'])->name('api.images.destroy');
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
