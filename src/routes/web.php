<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EventoController; // Agregado



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('tareas', TareaController::class);
    Route::patch('/tareas/{tarea}/completar', [TareaController::class, 'completar'])->name('tareas.completar');



    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::post('/calendar', [CalendarController::class, 'store'])->name('calendar.store');

    Route::resource('eventos', EventoController::class); // Agregado

    Route::get('/pomodoro', function () {
        return view('pomodoro.index');
    })->name('pomodoro'); // Añade ->name('pomodoro') aquí

    
});

require __DIR__.'/auth.php';
