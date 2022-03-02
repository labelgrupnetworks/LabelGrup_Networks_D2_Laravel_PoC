<?php

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

Route::group(['prefix' => '/product'], function (){
    Route::get('/', [\App\Http\Controllers\ProductController::class, 'index']);
    Route::post('/create', [\App\Http\Controllers\ProductController::class, 'create']);
    Route::patch('/update/{id}/{category_id}/{main_category_id}', [\App\Http\Controllers\ProductController::class, 'edit']);
    Route::delete('/delete/{id}', [\App\Http\Controllers\ProductController::class, 'delete']);
});
