<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::patch('/users/{user}', [\App\Http\Controllers\Api\UserController::class, 'update']);
    Route::delete('/users/{user}', [\App\Http\Controllers\Api\UserController::class, 'destroy']);
});
