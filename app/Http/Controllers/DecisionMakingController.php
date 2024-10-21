<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DecisionMaking;

class DecisionMakingController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el término de búsqueda si existe
        $search = $request->input('search');

        // Paginación y búsqueda
        $decisions = DecisionMaking::when($search, function ($query, $search) {
                            return $query->where('entry_date', 'like', "%{$search}%")
                                         ->orWhere('name', 'like', "%{$search}%")
                                         ->orWhere('archive', 'like', "%{$search}%");
                                         
                        })
                        ->orderBy('entry_date') // Cambia 'title' al nombre correcto de la columna que existe en tu tabla
                        ->paginate(10);

        return view('decision_making_directory', compact('decisions', 'search'));
    }
}
