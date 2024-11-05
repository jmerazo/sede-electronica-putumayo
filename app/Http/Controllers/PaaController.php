<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paa;

class PaaController extends Controller
{
    public function index(Request $request)
    {
        // Obtén el término de búsqueda si existe
        $search = $request->input('search');

        // Consultar la base de datos de PAA aplicando paginación
        $paas = Paa::when($search, function ($query, $search) {
                    return $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(10);

        // Pasar los resultados y el término de búsqueda a la vista
        return view('paa', compact('paas', 'search'));
    }
}
