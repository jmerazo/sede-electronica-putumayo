<?php

namespace App\Http\Controllers;

use App\Models\Participate;
use Illuminate\Http\Request;

class ParticipateController extends Controller
{
    public function index()
    {
        $participates = Participate::all();
        return view('participate', compact('participates'));
    }

    public function show($id)
    {
        // Cargar la participación con sus secciones
        $participate = Participate::with('sections')->findOrFail($id);
        return view('show', compact('participate'));
    }
}
