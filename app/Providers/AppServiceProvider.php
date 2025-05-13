<?php
namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Models\Module;
use App\View\Components\Navbar;
use App\View\Composers\BreadcrumbComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Registrar el componente de Blade
        Blade::component('navbar', Navbar::class);
        
        // Configurar el idioma de la aplicación según la sesión
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }

        // Compartir los menús con todas las vistas, incluyendo submenús y sub-submenús
        View::composer('*', function ($view) {
            $menus = Menu::with('submenus.subsubmenus')->orderBy('order')->get();
            $view->with('menus', $menus);
        });

        View::composer('*', BreadcrumbComposer::class);

        View::composer('*', function ($view) {
            if (Auth::check()) {
                // Cargar módulos con sus submódulos
                $modules = Auth::user()->modules()->with('submodules')->get();
                $view->with('modules', $modules);
            }
        });
    }
}