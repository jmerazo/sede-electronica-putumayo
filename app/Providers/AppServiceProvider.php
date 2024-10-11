<?php
namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use App\Models\Menu;
use App\View\Components\Navbar;

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

        // Compartir los menús con todas las vistas
        View::composer('*', function ($view) {
            $menus = Menu::with('submenus')->orderBy('order')->get();
            $view->with('menus', $menus);
        });
    }
}