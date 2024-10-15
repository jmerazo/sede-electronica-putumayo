<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dependency;

class DirectoryController extends Controller
{
    public function index(Request $request)
    {
        // Obtén el término de búsqueda si existe
        $search = $request->input('search');

        // Cargar solo los campos necesarios, aplicando el filtro de búsqueda y paginación
        $directorio = Dependency::select('name', 'description', 'cellphone', 'email')
                        ->when($search, function ($query, $search) {
                            return $query->where('name', 'like', "%{$search}%");
                        })
                        ->orderBy('name')
                        ->paginate(10); // Cambia 10 por el número de elementos que quieras por página

        // Pasar los datos y el término de búsqueda a la vista
        return view('directorio', compact('directorio', 'search'));
    }
}


