<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransparenciaController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\MisionController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\DirectoryController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/set-locale/{lang}', [App\Http\Controllers\LanguageController::class, 'setLocale'])->name('setLocale');
Route::get('/transparencia', [TransparenciaController::class, 'index'])->name('transparencia');
Route::get('/mision', [MisionController::class, 'index'])->name('mision');
Route::get('/navbar', [MenuController::class, 'index']);
Route::get('/directorio', [DirectoryController::class, 'index'])->name('directorio');
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

