<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransparenciaController;
use App\Http\Controllers\MisionController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SubmenuController;
use App\Http\Controllers\SubsubmenuController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\AssociationController;
use App\Http\Controllers\DecisionMakingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ControlEntitiesController;
use App\Http\Controllers\DecisionsController;
use App\Http\Controllers\UtilsController;
use App\Http\Controllers\LawController;
use App\Http\Controllers\ProgramPlanController;
use App\Http\Controllers\RegulationController;
use App\Http\Controllers\DecretoReglamentarioController;
use App\Http\Controllers\SidebarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SubmoduleController;
use App\Http\Controllers\UserModulePermissionController;
use App\Http\Controllers\SliderImageController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DependencyController;
use App\Http\Controllers\ContracController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\PlantOfficialController;
use App\Http\Controllers\EntitySettingController;
use App\Http\Controllers\LocateController;
use App\Http\Controllers\GovermentController;
use App\Http\Controllers\MipgController;
use App\Http\Controllers\OAuthController;
use App\Models\EntitySetting;

// Auth
Route::get('/login/google', [OAuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [OAuthController::class, 'handleGoogleCallback']);
Route::get('/login/outlook', [OAuthController::class, 'redirectToOutlook'])->name('login.outlook');
Route::get('/login/outlook/callback', [OAuthController::class, 'handleOutlookCallback']);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.show');
Route::get('/submenu/{id}', [SubmenuController::class, 'show'])->name('submenu.show');
Route::get('/subsubmenu/{id}', [SubsubmenuController::class, 'show'])->name('subsubmenu.show');
Route::get('/publications/{id}', [PublicationController::class, 'show'])->name('publications.show');
Route::get('/publications', [PublicationController::class, 'index'])->name('publications');
Route::get('/set-locale/{lang}', [App\Http\Controllers\LanguageController::class, 'setLocale'])->name('setLocale');
Route::get('/transparencia', [TransparenciaController::class, 'index'])->name('transparencia.index');
Route::get('/transparencia/{id}', [TransparenciaController::class, 'show'])->name('transparencia.show');
Route::get('/mision', [MisionController::class, 'index'])->name('mision');
Route::get('/subelement/{id}', [SidebarController::class, 'show'])->name('subelemento.show');
Route::get('/navbar', [MenuController::class, 'index']);
Route::get('/directory', [DependencyController::class, 'indexPublic'])->name('directory');
Route::get('/directory-active', [PlantOfficialController::class, 'directory'])->name('directory-personal');
Route::get('/entities-directory', [EntityController::class, 'indexPublic'])->name('entities_directory');
Route::get('/associations-directory', [AssociationController::class, 'publicIndex'])->name('associations_directory');
Route::get('/decision-making-directory', [DecisionMakingController::class, 'index'])->name('decision_making_directory');
Route::get('/calendar', [EventController::class, 'indexGeneral'])->name('calendar');
Route::get('/control-entities', [ControlEntitiesController::class, 'index'])->name('control_entities');
Route::get('/decisions', [DecisionsController::class, 'index'])->name('decisions');
Route::get('/resume', [UtilsController::class, 'index'])->name('resume');
Route::get('/laws', [LawController::class, 'indexPublic'])->name('laws');
Route::get('/program-plans', [ProgramPlanController::class, 'index'])->name('program_plans');
Route::get('/regulations', [RegulationController::class, 'index'])->name('regulations');
Route::get('/decretoreglamentario', [DecretoReglamentarioController::class, 'index'])->name('decretoreglamentario');
Route::get('/locates', [LocateController::class, 'index'])->name('locates');
Route::get('/locates/cities/{department_id}', [LocateController::class, 'getCities']);

// Goverment
Route::get('/cabinet/{typeCharge}', [GovermentController::class, 'governorIndex'])->name('cabinet.index');
Route::get('/cabinet/{typeCharge}/{id}', [GovermentController::class, 'governorShow'])->name('cabinet.show');

// Settings
Route::get('/entity/settings', [EntitySettingController::class, 'entitysettings'])->name('entitysettings');

Route::middleware(['auth:sanctum', 'verified'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/dependencies/all', [DependencyController::class, 'getDependencies'])->name('dependenciesAll');
    Route::resource('dependencies', DependencyController::class)->names([
        'index'   => 'dashboard.dependencies.index',
        'create'  => 'dashboard.dependencies.create',
        'store'   => 'dashboard.dependencies.store',
        'show'    => 'dashboard.dependencies.show',
        'edit'    => 'dashboard.dependencies.edit',
        'update'  => 'dashboard.dependencies.update',
        'destroy' => 'dashboard.dependencies.destroy'
    ]);

    Route::get('/users/bosses', [UserController::class, 'getBossesArea'])->name('bosses');
    Route::resource('users', UserController::class)->names([
        'index'   => 'dashboard.users.index',
        'create'  => 'dashboard.users.create',
        'store'   => 'dashboard.users.store',
        'show'    => 'dashboard.users.show',
        'edit'    => 'dashboard.users.edit',
        'update'  => 'dashboard.users.update',
        'destroy' => 'dashboard.users.destroy'
    ]);

    Route::resource('roles', RolController::class)->names([
        'index'   => 'dashboard.roles.index',
        'create'  => 'dashboard.roles.create',
        'store'   => 'dashboard.roles.store',
        'show'    => 'dashboard.roles.show',
        'edit'    => 'dashboard.roles.edit',
        'update'  => 'dashboard.roles.update',
        'destroy' => 'dashboard.roles.destroy'
    ]);

    Route::resource('permissions', PermissionController::class)->names([
        'index'   => 'dashboard.permissions.index',
        'create'  => 'dashboard.permissions.create',
        'store'   => 'dashboard.permissions.store',
        'show'    => 'dashboard.permissions.show',
        'edit'    => 'dashboard.permissions.edit',
        'update'  => 'dashboard.permissions.update',
        'destroy' => 'dashboard.permissions.destroy'
    ]);

    Route::resource('modules', ModuleController::class)->names([
        'index'   => 'dashboard.modules.index',
        'create'  => 'dashboard.modules.create',
        'store'   => 'dashboard.modules.store',
        'show'    => 'dashboard.modules.show',
        'edit'    => 'dashboard.modules.edit',
        'update'  => 'dashboard.modules.update',
        'destroy' => 'dashboard.modules.destroy'
    ]);

    Route::get('usermodules/user/{userId}/submodules', [UserModulePermissionController::class, 'getUserSubmodules'])
    ->name('dashboard.usermodules.getUserSubmodules');
    Route::resource('submodules', SubmoduleController::class)->names([
        'index'   => 'dashboard.submodules.index',
        'create'  => 'dashboard.submodules.create',
        'store'   => 'dashboard.submodules.store',
        'show'    => 'dashboard.submodules.show',
        'edit'    => 'dashboard.submodules.edit',
        'update'  => 'dashboard.submodules.update',
        'destroy' => 'dashboard.submodules.destroy'
    ]);

    Route::resource('usermodules', UserModulePermissionController::class)->names([
        'index'   => 'dashboard.usermodules.index',
        'create'  => 'dashboard.usermodules.create',
        'store'   => 'dashboard.usermodules.store',
        'show'    => 'dashboard.usermodules.show',
        'edit'    => 'dashboard.usermodules.edit',
        'update'  => 'dashboard.usermodules.update',
        'destroy' => 'dashboard.usermodules.destroy'
    ]);

    // **Rutas personalizadas para asignar, obtener y revocar permisos**
    Route::post('usermodules/sync-modules', [UserModulePermissionController::class, 'syncModules'])->name('dashboard.usermodules.syncModules');
    Route::post('usermodules/sync', [UserModulePermissionController::class, 'syncPermissions'])->name('dashboard.usermodules.sync');
    Route::post('usermodules/assign', [UserModulePermissionController::class, 'assignPermission'])->name('dashboard.usermodules.assign');
    Route::get('usermodules/user/{userId}/permissions', [UserModulePermissionController::class, 'getUserPermissions'])->name('dashboard.usermodules.getUserPermissions');
    Route::post('usermodules/revoke', [UserModulePermissionController::class, 'revokePermission'])->name('dashboard.usermodules.revoke');

    Route::get('submodules/by-module/{module_id}', [SubmoduleController::class, 'getSubmodulesByModule'])
    ->name('dashboard.submodules.byModule');

    // Listar solo las imágenes activas (para la página pública)
    Route::get('slider/images/active', [SliderImageController::class, 'getActive'])
    ->name('dashboard.sliderimages.active');

    // Cambiar el estado (activar/desactivar)
    Route::patch('slider/images/{id}/toggle-status', [SliderImageController::class, 'toggleStatus'])
    ->name('dashboard.sliderimages.toggleStatus');

    // Actualizar el orden de una imagen
    Route::patch('slider/images/{id}/order', [SliderImageController::class, 'updateOrder'])
    ->name('dashboard.sliderimages.updateOrder');
    Route::patch('slider/images/{id}/toggle-status', [SliderImageController::class, 'toggleStatus'])
    ->name('dashboard.sliderimages.toggleStatus');
    Route::resource('slider/images', SliderImageController::class)->names([
        'index'   => 'dashboard.sliderimages.index',
        'create'  => 'dashboard.sliderimages.create',
        'store'   => 'dashboard.sliderimages.store',
        'show'    => 'dashboard.sliderimages.show',
        'edit'    => 'dashboard.sliderimages.edit',
        'update'  => 'dashboard.sliderimages.update',
        'destroy' => 'dashboard.sliderimages.destroy'
    ]);

    Route::resource('publication', PublicationController::class)->names([
        'index'   => 'dashboard.publication.index',
        'create'  => 'dashboard.publication.create',
        'store'   => 'dashboard.publication.store',
        'show'    => 'dashboard.publication.show',
        'edit'    => 'dashboard.publication.edit',
        'update'  => 'dashboard.publication.update',
        'destroy' => 'dashboard.publication.destroy'
    ]);

    Route::resource('report', ReportController::class)->names([
        'index'   => 'dashboard.report.index',
        'create'  => 'dashboard.report.create',
        'store'   => 'dashboard.report.store',
        'show'    => 'dashboard.report.show',
        'edit'    => 'dashboard.report.edit',
        'update'  => 'dashboard.report.update',
        'destroy' => 'dashboard.report.destroy'
    ]);

    Route::resource('association', AssociationController::class)->names([
        'index'   => 'dashboard.association.index',
        'create'  => 'dashboard.association.create',
        'store'   => 'dashboard.association.store',
        'show'    => 'dashboard.association.show',
        'edit'    => 'dashboard.association.edit',
        'update'  => 'dashboard.association.update',
        'destroy' => 'dashboard.association.destroy'
    ]);

    Route::resource('contracs', ContracController::class)->names([
        'index'   => 'dashboard.contracs.index',
        'create'  => 'dashboard.contracs.create',
        'store'   => 'dashboard.contracs.store',
        'show'    => 'dashboard.contracs.show',
        'edit'    => 'dashboard.contracs.edit',
        'update'  => 'dashboard.contracs.update',
        'destroy' => 'dashboard.contracs.destroy'
    ]);

    Route::resource('entities', EntityController::class)->names([
        'index'   => 'dashboard.entities.index',
        'create'  => 'dashboard.entities.create',
        'store'   => 'dashboard.entities.store',
        'show'    => 'dashboard.entities.show',
        'edit'    => 'dashboard.entities.edit',
        'update'  => 'dashboard.entities.update',
        'destroy' => 'dashboard.entities.destroy'
    ]);

    Route::post('/contractors/import', [ContractorController::class, 'import'])->name('dashboard.contractors.import');
    Route::get('/contractors/export', [ContractorController::class, 'exportContractors'])->name('dashboard.contractors.export');
    Route::resource('contractors', ContractorController::class)->names([
        'index'   => 'dashboard.contractors.index',
        'create'  => 'dashboard.contractors.create',
        'store'   => 'dashboard.contractors.store',
        'show'    => 'dashboard.contractors.show',
        'edit'    => 'dashboard.contractors.edit',
        'update'  => 'dashboard.contractors.update',
        'destroy' => 'dashboard.contractors.destroy'
    ]);

    Route::get('/plantofficials/export', [PlantOfficialController::class, 'exportPlantOfficial'])->name('dashboard.plantofficials.export');
    Route::resource('plantofficials', PlantOfficialController::class)->names([
        'index'   => 'dashboard.plantofficials.index',
        'create'  => 'dashboard.plantofficials.create',
        'store'   => 'dashboard.plantofficials.store',
        'show'    => 'dashboard.plantofficials.show',
        'edit'    => 'dashboard.plantofficials.edit',
        'update'  => 'dashboard.plantofficials.update',
        'destroy' => 'dashboard.plantofficials.destroy'
    ]);

    Route::resource('events', EventController::class)->names([
        'index'   => 'dashboard.events.index',
        'create'  => 'dashboard.events.create',
        'store'   => 'dashboard.events.store',
        'show'    => 'dashboard.events.show',
        'edit'    => 'dashboard.events.edit',
        'update'  => 'dashboard.events.update',
        'destroy' => 'dashboard.events.destroy'
    ]);

    Route::resource('settings', EntitySettingController::class)->names([
        'index'   => 'dashboard.settings.index',
        'create'  => 'dashboard.settings.create',
        'store'   => 'dashboard.settings.store',
        'show'    => 'dashboard.settings.show',
        'edit'    => 'dashboard.settings.edit',
        'update'  => 'dashboard.settings.update',
        'destroy' => 'dashboard.settings.destroy'
    ]);

    Route::resource('laws', LawController::class)->names([
        'index'   => 'dashboard.laws.index',
        'create'  => 'dashboard.laws.create',
        'store'   => 'dashboard.laws.store',
        'show'    => 'dashboard.laws.show',
        'edit'    => 'dashboard.laws.edit',
        'update'  => 'dashboard.laws.update',
        'destroy' => 'dashboard.laws.destroy'
    ]);

    Route::post('/mipg/rename/{id}', [MipgController::class, 'rename'])->name('mipg.rename');
    Route::post('/mipg/folder', [MipgController::class, 'storeFolder'])->name('storeFolder');
    Route::post('/mipg/upload', [MipgController::class, 'upload'])->name('mipg.upload');
    Route::post('/mipg/{id}/assign-area', [MipgController::class, 'assignArea']);
    Route::get('/mipg/dependency-summary', [MipgController::class, 'dependencySummary']);
    Route::get('/mipg/type-summary', [MipgController::class, 'typeSummary']);
    Route::patch('/mipg/{id}/toggle-visibility', [MipgController::class, 'toggleVisibility'])->name('mipg.toggle-visibility');
    Route::resource('mipg', MipgController::class)->names([
        'index'   => 'dashboard.mipg.index',
        'create'  => 'dashboard.mipg.create',
        'store'   => 'dashboard.mipg.store',
        'show'    => 'dashboard.mipg.show',
        'edit'    => 'dashboard.mipg.edit',
        'update'  => 'dashboard.mipg.update',
        'destroy' => 'dashboard.mipg.destroy'
    ]);
});