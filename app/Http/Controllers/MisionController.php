<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transparency;

class MisionController extends Controller
{
    public function index($id)
    {
        // Buscar la sección de "Misión" usando el ID
        $misionSection = Transparency::where('tipo', 'seccion')->where('id', $id)->first();

        // Verificar si la sección existe
        if (!$misionSection) {
            abort(404); // Si no existe, mostrar página 404
        }

        // Obtener los subelementos de la sección "Misión"
        $subElementos = Transparency::where('tipo', 'subelemento')
            ->where('id_padre', $misionSection->id)
            ->orderBy('orden')
            ->get();

        // Pasar los subelementos a la vista
        return view('mision', compact('subElementos', 'misionSection'));
    }
}