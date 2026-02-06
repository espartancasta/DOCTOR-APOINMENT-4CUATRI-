<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PatientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;




Route::get('/', function(){
    return view ('admin.dashboard');
})->name('dashboard');

//Gestión de Roles
Route::resource('roles',RoleController::class);

//Gestión de Usuarios
Route::resource('users', UserController::class);
Route::resource('patients', PatientController::class);

Route::get('/gestion', function () {
    return view('admin.gestion.index');
})->name('admin.gestion');
