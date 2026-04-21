<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');


Route::middleware(['auth'])->group(function () {
    

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    Route::get('/direcciones', [DireccionController::class, 'index'])->name('direcciones.index');
    Route::get('/direcciones/nuevo', [DireccionController::class, 'create'])->name('direcciones.create');
    Route::post('/direcciones/guardar', [DireccionController::class, 'store'])->name('direcciones.store');
    

    Route::get('/direcciones/{id}/editar', [DireccionController::class, 'edit'])->name('direcciones.edit');
    Route::put('/direcciones/{id}', [DireccionController::class, 'update'])->name('direcciones.update');
    

    Route::delete('/direcciones/{id}', [DireccionController::class, 'destroy'])->name('direcciones.destroy');
});