<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ControlEntity;

class ControlEntitiesController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el término de búsqueda, si existe
        $search = $request->input('search');

        // Consultar la base de datos y aplicar paginación
        $entities = ControlEntity::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(5); // Puedes ajustar el número de registros por página

        // Pasar los datos a la vista
        return view('transparencia.subelements.control_entities', compact('entities', 'search'));
    }
}
