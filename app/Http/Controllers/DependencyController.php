<?php
namespace App\Http\Controllers;

use App\Models\Dependency;
use Illuminate\Http\Request;

class DependencyController extends Controller
{
    public function index()
    {
        // Cargar menús con sus submenús ordenados
        $dependencies = Dependency::with('subdependencies')->get();

        // Pasar los menús a la vista
        return view('navbar', compact('dependencies'));
    }
}