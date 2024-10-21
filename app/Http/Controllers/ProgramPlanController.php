<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramPlan;

class ProgramPlanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Consultar los datos de la tabla 'program_plans' con búsqueda y paginación
        $programPlans = ProgramPlan::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('tipo', 'like', "%{$search}%")
                         ->orWhere('theme', 'like', "%{$search}%");
        })->paginate(5);

        return view('program_plans', compact('programPlans', 'search'));
    }
}