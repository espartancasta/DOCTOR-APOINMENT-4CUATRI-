<?php

<<<<<<< HEAD
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
=======
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::delete('/user', [UserController::class, 'destroySelf']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
});
>>>>>>> 4ebee93 (Add automated test for user self-delete restriction)
