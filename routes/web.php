<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Rutas Web
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas web para tu aplicación. Estas
| rutas son cargadas por el RouteServiceProvider y todas serán asignadas al
| grupo de middleware "web".
|
*/

// Ruta para la página de inicio, accesible para todos
Route::get('/', [HomeController::class, 'index'])->name('home');
// routes/web.php
Route::get('/set-locale/{lang}', [App\Http\Controllers\LanguageController::class, 'setLocale'])->name('setLocale');


// Rutas que requieren autenticación
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Ruta para el dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Puedes añadir más rutas protegidas aquí
});
