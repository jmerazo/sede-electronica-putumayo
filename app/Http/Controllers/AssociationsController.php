<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Association;

class AssociationsController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el término de búsqueda si existe
        $search = $request->input('search');

        // Paginación y búsqueda
        $associations = Association::when($search, function ($query, $search) {
                            return $query->where('name', 'like', "%{$search}%")
                                         ->orWhere('classification', 'like', "%{$search}%")
                                         ->orWhere('activity', 'like', "%{$search}%")
                                         ->orWhere('phone', 'like', "%{$search}%");
                        })
                        ->orderBy('name')
                        ->paginate(5); // Cambia 10 al número de registros por página deseado

        return view('associations_directory', compact('associations', 'search'));
    }
}
