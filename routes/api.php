<?php

use App\Http\Controllers\ApiTestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthJwtController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(ApiTestController::class)->group(function () {
    Route::get('private-endpoint', 'privateEndopint');
});

Route::controller(AuthJwtController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('refresh', 'refresh');
    Route::post('blacklist', 'blacklist');
    Route::post('logout', 'logout');
    Route::get('get-token/{user_id}', 'getTokenByUser');
});