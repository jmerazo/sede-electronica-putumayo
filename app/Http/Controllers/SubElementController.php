<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transparency;

class SidebarController extends Controller
{
    public function index()
    {
        // Obtener todas las secciones con sus subelementos
        $secciones = Transparency::where('tipo', 'seccion')->orderBy('orden')->get();
        foreach ($secciones as $seccion) {
            $seccion->subElementos = Transparency::where('tipo', 'subelemento')
                ->where('id_padre', $seccion->id)
                ->orderBy('orden')
                ->get();
        }

        // Pasar los datos de las secciones y sus subelementos a la vista de la sidebar
        return view('partials.sidebar', compact('secciones'));
    }
}