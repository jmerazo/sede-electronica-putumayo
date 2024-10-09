<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransparenciaController extends Controller
{
    public function index()
    {
        // Obtener todas las secciones
        $secciones = DB::table('transparencia')->where('tipo', 'seccion')->orderBy('orden')->get();

        return view('transparencia', compact('secciones'));
    }
}
