<?php

use App\Http\Controllers\CitaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

//Agendar cita crear, almacenar
use App\Http\Controllers\AgendaController;
Route::get('/agendas/create', [AgendaController::class, 'create'])->name('agendas.create');
Route::post('/agendas/store', [AgendaController::class, 'store'])->name('agendas.store');
Route::post('/agendas/{id}/atendida', [AgendaController::class, 'atendida'])->name('agendas.atendida');

//Usuarios, crear,almacenar,destruir
use App\Http\Controllers\UsersController;

Route::middleware(['auth'])->group(function () {
    Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
    Route::post('/users', [UsersController::class, 'store'])->name('users.store');
    Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
});

#Nav Bar (Parte de arriba)
Route::get('/', [MenuController::class, 'welcome'])->middleware(['auth', 'verified'])->name('welcome');
Route::get('/dashboard', [MenuController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/pacientes', [MenuController::class, 'pacientes'])->middleware(['auth', 'verified'])->name('pacientes');
Route::get('/productos', [MenuController::class, 'productos'])->middleware(['auth', 'verified'])->name('productos');
Route::get('/usuarios', [MenuController::class, 'usuarios'])->middleware(['auth', 'verified'])->name('usuarios');
Route::get('/calendario', [MenuController::class, 'calendario'])->middleware(['auth', 'verified'])->name('calendario');

#Pestaña de pacientes registrar, borrar, almacenar
Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
Route::post('/patients/store', [PatientController::class, 'store'])->name('patients.store');
Route::delete('/patients/{id}', [PatientController::class, 'destroy'])->name('patients.destroy');
Route::patch('/patients/{id}', [PatientController::class, 'update'])->name('patients.update');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
