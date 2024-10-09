<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/set-locale/{lang}', [App\Http\Controllers\LanguageController::class, 'setLocale'])->name('setLocale');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


Route::get('/transparencia', [TransparenciaController::class, 'index'])->name('transparencia');

Route::get('/mision', [MisionController::class, 'index'])->name('mision');

