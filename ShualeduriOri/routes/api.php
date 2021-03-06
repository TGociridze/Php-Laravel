<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);

Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);



Route::prefix('posts')->middleware('auth:api')->group(function() {
    Route::get('/', [\App\Http\Controllers\Api\PostController::class, 'index']);
});

Route::post('/fill-balance', [\App\Http\Controllers\Api\AuthController::class, 'fillBalance'])->middleware('auth:api');

Route::post('/transfer', [\App\Http\Controllers\Api\AuthController::class, 'transfer']);
