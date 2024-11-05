<?php

namespace App\Http\Controllers;

use App\Models\Participate;
use Illuminate\Http\Request;

class ParticipateController extends Controller
{
    public function index()
    {
        // Obtener todas las participaciones de la base de datos
        $participates = Participate::all();

        // Retornar la vista principal con la lista de participaciones
        return view('participate', compact('participates'));
    }

    public function show($id)
    {
        // Buscar el registro de participación por ID
        $participate = Participate::findOrFail($id);

        // Retornar la vista de detalle de la participación
        return view('participate.show', compact('participate'));
    }
}
