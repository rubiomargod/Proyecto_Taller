<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('Guest');
});

Route::get('/Inicio', function () {
  return view('App');
})->middleware(['auth', 'verified'])->name('INICIO');

Route::get('/Mantenimientos', function () {
  return view('Layouts.Mantenimientos.Mantenimientos');
})->middleware(['auth', 'verified'])->name('MANTENIMIENTOS');

Route::get('/Maquinas', function () {
  return view('Layouts.Maquinas.Maquinas');
})->middleware(['auth', 'verified'])->name('MAQUINAS');

Route::get('/Mecanicos', function () {
  return view('Layouts.Mecanicos.Mecanicos');
})->middleware(['auth', 'verified'])->name('MECANICOS');

Route::get('/Piezas', function () {
  return view('Layouts.Piezas.Piezas');
})->middleware(['auth', 'verified'])->name('PIEZAS');

Route::middleware('auth')->group(function () {
  Route::get('/Perfil', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/Perfil', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/Perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
