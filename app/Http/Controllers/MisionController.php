<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MisionController extends Controller
{
    public function index()
    {
        // Solo retornamos la vista de Misión sin datos de la base de datos
        return view('transparencia.subelements.mision');
    }
}