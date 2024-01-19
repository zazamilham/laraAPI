<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\V1\PostController as V1PostController;
use App\Http\Controllers\V2\PostController as V2PostController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('v1')->group(function () {
    Route::apiResource('posts', V1PostController::class);
    Route::apiResource('users', UserController::class);
});

Route::prefix('v2')->group(function () {
    Route::apiResource('posts', V2PostController::class);
    Route::apiResource('users', UserController::class);
});

Route::post('register', [AuthController::class,'register']);






