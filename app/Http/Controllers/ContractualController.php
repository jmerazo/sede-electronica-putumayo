<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contractual; // Ajusta el modelo según tu estructura

class ContractualController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        // Consultar los datos con paginación y aplicar el filtro de búsqueda si es necesario
        $contracts = Contractual::when($search, function($query, $search) {
                            return $query->where('name', 'like', "%{$search}%")
                                         ->orWhere('description', 'like', "%{$search}%");
                        })
                        ->orderBy('name')
                        ->paginate(5); // Ajusta la cantidad de resultados por página

        return view('contractual', compact('contracts', 'search'));
    }
}
