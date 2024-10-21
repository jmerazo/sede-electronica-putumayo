<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Decision;  // Asegúrate de tener el modelo 'Decision'

class DecisionsController extends Controller
{
    public function index(Request $request)
    {
        // Término de búsqueda si existe
        $search = $request->input('search');

        // Consulta la base de datos con paginación y búsqueda
        $decisions = Decision::when($search, function ($query, $search) {
                            return $query->where('name', 'like', "%{$search}%");
                        })
                        ->paginate(10); // Puedes ajustar el número de resultados por página

        // Pasar los resultados a la vista
        return view('decisions', compact('decisions', 'search'));
    }
}
