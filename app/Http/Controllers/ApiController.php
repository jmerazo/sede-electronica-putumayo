<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Dependency;

class ApiController extends Controller
{
    public function getMenu()
    {
        $menus = Menu::with('submenus')->orderBy('order')->get();
        return response()->json($menus);
    }

    public function getDependencies()
    {
        return Dependency::all();
    }
}
