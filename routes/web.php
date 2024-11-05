<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransparenciaController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\MisionController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SubmenuController;
use App\Http\Controllers\SubsubmenuController;
use App\Http\Controllers\PublicationsController;
use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\ServersDirectoryController;
use App\Http\Controllers\EntitiesController;
use App\Http\Controllers\AssociationsController;
use App\Http\Controllers\DecisionMakingController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ControlEntitiesController;
use App\Http\Controllers\DecisionsController;
use App\Http\Controllers\LeavesLifeController;
use App\Http\Controllers\LawController;
use App\Http\Controllers\ProgramPlanController;
use App\Http\Controllers\RegulationController;
use App\Http\Controllers\DecretoReglamentarioController;
use App\Http\Controllers\SidebarController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.show');
Route::get('/submenu/{id}', [SubmenuController::class, 'show'])->name('submenu.show');
Route::get('/subsubmenu/{id}', [SubsubmenuController::class, 'show'])->name('subsubmenu.show');
Route::get('/publications', [PublicationsController::class, 'index'])->name('publications');
Route::get('/publications/{id}', [PublicationsController::class, 'show'])->name('publications.show');
Route::get('/set-locale/{lang}', [App\Http\Controllers\LanguageController::class, 'setLocale'])->name('setLocale');
Route::get('/transparencia', [TransparenciaController::class, 'index'])->name('transparencia.index');
Route::get('/transparencia/{id}', [TransparenciaController::class, 'show'])->name('transparencia.show');
Route::get('/mision', [MisionController::class, 'index'])->name('mision');
Route::get('/subelement/{id}', [SidebarController::class, 'show'])->name('subelemento.show');
Route::get('/navbar', [MenuController::class, 'index']);
Route::get('/directorio', [DirectoryController::class, 'index'])->name('directorio');
Route::get('/servers-directory', [ServersDirectoryController::class, 'index'])->name('servers-directory');
Route::get('/entities-directory', [EntitiesController::class, 'index'])->name('entities_directory');
Route::get('/associations-directory', [AssociationsController::class, 'index'])->name('associations_directory');
Route::get('/decision-making-directory', [DecisionMakingController::class, 'index'])->name('decision_making_directory');
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
Route::get('/control-entities', [ControlEntitiesController::class, 'index'])->name('control_entities');
Route::get('/decisions', [DecisionsController::class, 'index'])->name('decisions');
Route::get('/leaves-life', [LeavesLifeController::class, 'index'])->name('leaves_life');
Route::get('/laws', [LawController::class, 'index'])->name('laws');
Route::get('/program-plans', [ProgramPlanController::class, 'index'])->name('program_plans');
Route::get('/regulations', [RegulationController::class, 'index'])->name('regulations');
Route::get('/decretoreglamentario', [DecretoReglamentarioController::class, 'index'])->name('decretoreglamentario');


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

