<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entity;

class EntitiesController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el término de búsqueda si existe
        $search = $request->input('search');

        // Paginación y búsqueda
        $entities = Entity::when($search, function ($query, $search) {
                            return $query->where('name', 'like', "%{$search}%")
                                         ->orWhere('description', 'like', "%{$search}%")
                                         ->orWhere('contact_email', 'like', "%{$search}%")
                                         ->orWhere('phone', 'like', "%{$search}%");
                        })
                        ->orderBy('name')
                        ->paginate(5); // Cambia 10 al número de registros por página deseado

        return view('transparencia.subelements.entities_directory', compact('entities', 'search'));
    }
}
