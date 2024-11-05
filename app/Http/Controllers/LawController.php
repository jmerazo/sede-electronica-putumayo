<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Law;

class LawController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Consultar los datos de la tabla 'laws' con búsqueda y paginación
        $laws = Law::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('number', 'like', "%{$search}%")
                         ->orWhere('theme', 'like', "%{$search}%");
        })->paginate(5);

        return view('transparencia.subelements.laws', compact('laws', 'search'));
    }
}
