<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropiedadesController;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\IncidenciasController;
use App\Http\Controllers\TareasController;

// Rutas para Incidencias
Route::resource('incidencias', IncidenciasController::class);

// Rutas para Tareas
Route::get('/tareas/{incidencia_id}', [TareasController::class, 'index'])->name('tareas.index');
Route::get('/tareas/create/{incidencia_id}', [TareasController::class, 'create'])->name('tareas.create'); // GET para el formulario de creación
Route::post('/tareas', [TareasController::class, 'store'])->name('tareas.store'); // POST para almacenar tareas
Route::get('/tareas/edit/{tarea_id}', [TareasController::class, 'edit'])->name('tareas.edit'); // GET para el formulario de edición
Route::put('/tareas/{tarea_id}', [TareasController::class, 'update'])->name('tareas.update'); // PUT para actualizar tareas

// Rutas para Propiedades y Reservas
Route::resource('propiedades', PropiedadesController::class);
Route::delete('propiedades/{propiedad}', [PropiedadesController::class, 'destroy'])->name('propiedades.destroy');

Route::resource('reservas', ReservasController::class);
Route::put('reservas/{id}', [ReservasController::class, 'update'])->name('reservas.update');
Route::get('reservas/propiedad/{propiedad}', [ReservasController::class, 'showReservas'])->name('reservas.showPropiedad');


