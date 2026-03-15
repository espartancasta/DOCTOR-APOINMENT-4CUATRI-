<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AppointmentController;

Route::redirect('/', '/admin'); // Redirige al admin por defecto

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard de administrador
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // vista en resources/views/admin/dashboard.blade.php
    })->name('dashboard');

    // Módulo de Citas (Actividad 10)
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    
    // Consulta Manager
    Route::get('/appointments/{appointment}/consultation', [AppointmentController::class, 'consultation'])->name('appointments.consultation');

    // Módulos añadidos
    Route::get('/doctors', [\App\Http\Controllers\Admin\DoctorController::class, 'index'])->name('doctors.index');
    Route::get('/doctors/{doctor}/schedules', [\App\Http\Controllers\Admin\DoctorController::class, 'schedules'])->name('doctors.schedules');
    
    Route::get('/calendar', function () { return view('admin.calendar'); })->name('calendar');
    Route::get('/support', function () { return view('admin.support'); })->name('support');
});
