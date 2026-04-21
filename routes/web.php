<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\AuthController;

// 1. Redirección inicial
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. Rutas de Autenticación y Registro (Públicas)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// 3. Rutas Protegidas (Solo para usuarios autenticados)
Route::middleware(['auth'])->group(function () {
    
    // Acción de cierre de sesión
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Gestión de la Agenda (CRUD Completo)
    Route::get('/direcciones', [DireccionController::class, 'index'])->name('direcciones.index');
    Route::get('/direcciones/nuevo', [DireccionController::class, 'create'])->name('direcciones.create');
    Route::post('/direcciones/guardar', [DireccionController::class, 'store'])->name('direcciones.store');
    
    // Rutas de Edición y Actualización (Ahora protegidas)
    Route::get('/direcciones/{id}/editar', [DireccionController::class, 'edit'])->name('direcciones.edit');
    Route::put('/direcciones/{id}', [DireccionController::class, 'update'])->name('direcciones.update');
    
    // Ruta de Eliminación
    Route::delete('/direcciones/{id}', [DireccionController::class, 'destroy'])->name('direcciones.destroy');
});