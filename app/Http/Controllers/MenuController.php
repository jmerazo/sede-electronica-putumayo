<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Cargar menús con sus submenús ordenados
        $menus = Menu::with('submenus')->orderBy('order')->get();

        // Pasar los menús a la vista
        return view('navbar', compact('menus'));
    }
}