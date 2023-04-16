<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\CategoryController;
use App\Http\Controllers\api\v1\ProductController;
use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\ImageController;

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

// Login & Register methods
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// protected routes
Route::middleware('auth:api')->group(function() {
    // Users crud
    Route::apiResource('users', AuthController::class);

    // Products crud
    Route::apiResource('products', ProductController::class);

    // Categories crud
    Route::apiResource('categories', CategoryController::class);

    // Assing categories to products
    Route::post('assignCategories/{id}', [ProductController::class, 'assignCategories']);

    // Images crud
    Route::apiResource('images', ImageController::class);

    // Need to be POST method to modify images, doesn't support PUT in form-data
    Route::post('images/{id}', [ImageController::class, 'update']);
});

// The catch-all will match anything except the previous defined routes.
Route::any('{catchall}', function () {
    return response()->json(["status" => 500, "message" => "bad or non existing method"], 500);
})->where('catchall', '.*');
