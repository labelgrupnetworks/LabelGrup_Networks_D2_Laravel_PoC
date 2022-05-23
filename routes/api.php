<?php


use App\Api\Controllers\Auth\AuthController;
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

Route::post('register', [AuthController::class, 'register'])->name('api.auth.register');
Route::post('login', [AuthController::class, 'login'])->name('api.auth.login');


Route::middleware('auth:sanctum')->group(function (){
    Route::get('logout', [AuthController::class, 'logout'])->name('api.auth.logout');
});
