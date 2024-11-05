<?php

namespace App\Http\Controllers;

use App\Models\HiringAnual;
use Illuminate\Http\Request;

class HiringAnualController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Filtrar los registros de acuerdo con la búsqueda
        $hiringAnuals = HiringAnual::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                         ->orWhere('tipo', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('hiring_anual', compact('hiringAnuals', 'search'));
    }
}

