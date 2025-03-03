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
use App\Http\Controllers\PaaController;
use App\Http\Controllers\ContractualController;
use App\Http\Controllers\ExecutionController;
use App\Http\Controllers\HiringAnualController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\FormalityController;
use App\Http\Controllers\JudicialNoticeController;
use App\Http\Controllers\PqrdReportController;
use App\Http\Controllers\DataProtectionController;
use App\Http\Controllers\ParticipateController;
use App\Http\Controllers\CommunicationsController;
use App\Http\Controllers\GabineteController;
use App\Http\Controllers\MicrositioController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.show');
Route::get('/submenu/{id}', [SubmenuController::class, 'show'])->name('submenu.show');
Route::get('/subsubmenu/{id}', [SubsubmenuController::class, 'show'])->name('subsubmenu.show');
Route::get('/publications', [PublicationsController::class, 'index'])->name('publications.index');
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
Route::get('/paa', [PaaController::class, 'index'])->name('paa');
Route::get('/contractual', [ContractualController::class, 'index'])->name('contractual');
Route::get('/execution', [ExecutionController::class, 'index'])->name('execution');
Route::get('/hiring-anual', [HiringAnualController::class, 'index'])->name('hiring_anual');

Route::get('/calendar', [AppointmentController::class, 'showCalendar'])->name('appointments.calendar');
Route::get('/form', [AppointmentController::class, 'showForm'])->name('appointments.form');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');

Route::get('/formalities', [FormalityController::class, 'index'])->name('formalities.index');
Route::get('/judicial-notices', [JudicialNoticeController::class, 'index'])->name('judicial_notices.index');
Route::get('/pqrds-reports', [PqrdReportController::class, 'index'])->name('pqrds_reports.index');
Route::get('/data-protection', [DataProtectionController::class, 'index'])->name('data_protection');
Route::get('/participate', [ParticipateController::class, 'index'])->name('participate.index');
Route::get('/participate/{id}', [ParticipateController::class, 'show'])->name('participate.show');
Route::get('/communications', [CommunicationsController::class, 'index'])->name('communications.index');
Route::get('/communications/{id}', [CommunicationsController::class, 'show'])->name('communications.show');
Route::get('/gabinete/{cargoTipo}', [GabineteController::class, 'index'])->name('gabinete.index');
Route::get('/gabinete/{cargoTipo}/{id}', [GabineteController::class, 'show'])->name('gabinete.show');

Route::prefix('micrositio1')->group(function () {
    Route::get('/', [MicrositioController::class, 'index'])->name('micrositio1.index');
    Route::get('/about', [MicrositioController::class, 'about'])->name('micrositio1.about');
    Route::get('/contact', [MicrositioController::class, 'contact'])->name('micrositio1.contact');
});

Route::prefix('micrositio2')->group(function () {
    Route::get('/', [MicrositioController::class, 'index'])->name('micrositio2.index');
    Route::get('/contact', [MicrositioController::class, 'contact'])->name('micrositio2.contact');
});


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

