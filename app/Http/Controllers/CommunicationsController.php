<?php

namespace App\Http\Controllers;

use App\Models\Communication;
use Illuminate\Http\Request;

class CommunicationsController extends Controller
{
    public function index()
    {
        // Obtener todos los comunicados
        $communications = Communication::orderBy('created_at', 'desc')->get();
        return view('communications', compact('communications'));
    }

    public function show($id)
    {
        // Obtener un comunicado específico
        $communication = Communication::findOrFail($id);
        return view('show_communications', compact('communication'));
    }
}
