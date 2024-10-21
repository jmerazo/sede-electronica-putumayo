<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransparenciaController;
use App\Http\Controllers\MisionController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PublicationsController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/publications', [PublicationsController::class, 'index'])->name('publications');
Route::get('/publications/{id}', [PublicationsController::class, 'show'])->name('publications.show');
Route::get('/set-locale/{lang}', [App\Http\Controllers\LanguageController::class, 'setLocale'])->name('setLocale');
Route::get('/transparencia', [TransparenciaController::class, 'index'])->name('transparencia.index');
Route::get('/transparencia/{id}', [TransparenciaController::class, 'show'])->name('transparencia.show');
Route::get('/mision/{id}', [MisionController::class, 'index'])->name('mision');
Route::get('/navbar', [MenuController::class, 'index']);
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

