<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MinijuegosController;
use App\Http\Controllers\PosicionesController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\LigasController;
use App\Http\Controllers\EquiposController;
use App\Http\Controllers\FutbolistasController;


Route::get('/', [MinijuegosController::class, 'index']);




Route::get('/admin', function (){ 
    return view('auth/login'); 
});

Route::get('/formulario_futbolistas', [FutbolistasController::class,'show'])->name('f_futbolista');
Route::post('/guardar_futbolista',[FutbolistasController::class, 'create'])->name('guardar_futbolista');
Route::get('/lista_futbolistas',[FutbolistasController::class, 'show_futbolistas'])->name('l_futbolistas');

Route::get('/formulario_equipo',[EquiposController::class, 'show'])->name('f_equipos');
Route::post('/guardar_equipo',[EquiposController::class, 'create'])->name('guardar_equipo');
Route::get('/lista_equipos',[EquiposController::class, 'show_equipos'])->name('l_equipos');
Route::get('/formulario_equipo/eliminar/{id}',[EquiposController::class,'delete'])->name('eliminar_equipo');
Route::post('/actualizar_equipo', [EquiposController::class, 'update'])->name('actualizar_equipo');

Route::get('/formulario_ligas',[LigasController::class,'show'])->name('f_ligas');
Route::post('/guardar_ligas',[LigasController::class, 'create'])->name('guardar_ligas');
Route::get('/formulario_ligas/eliminar/{id}', [LigasController::class, 'delete'])->name('eliminar_ligas');
Route::post('/actualizar_ligas', [LigasController::class, 'update'])->name('actualizar_ligas');

Route::get('/formulario_pais', [PaisController::class,'show'])->name('f_pais');
Route::post('/guardar_pais',[PaisController::class, 'create'])->name('guardar_pais');
Route::get('/formulario_pais/eliminar/{id}', [PaisController::class, 'delete'])->name('eliminar_pais');
Route::post('/actualizar_pais', [PaisController::class, 'update'])->name('actualizar_pais');

Route::get('/formulario_posiciones', [PosicionesController::class, 'show'])->name('f_posiciones');
Route::post('/guardar_posiciones',[PosicionesController::class, 'create'])->name('crear_posiciones');
Route::get('/formulario_posiciones/eliminar/{id}', [PosicionesController::class, 'delete'])->name('eliminar_posiciones');
Route::post('/actualizar_posiciones', [PosicionesController::class, 'actualizar'])->name('actualizar_posiciones');


Route::get('/ad_registro', function (){ 
    return view('auth/register'); 
})->name('ad_resgistro');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
