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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->resource('characters', \App\Http\Controllers\CharacterController::class)->only([
    'index', 'show', 'update'
]);

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::middleware('auth:api')->get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
