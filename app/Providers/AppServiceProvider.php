<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use App\View\Components\Navbar;
use Illuminate\Support\Facades\Blade;

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
        Blade::component('navbar', Navbar::class);
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
    }
}
