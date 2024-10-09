<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/menu', [ApiController::class, 'getMenu']);
Route::get('/dependencies', [ApiController::class, 'getDependencies']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});