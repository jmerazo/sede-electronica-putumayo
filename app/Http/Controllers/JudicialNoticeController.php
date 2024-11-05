<?php

namespace App\Http\Controllers;

use App\Models\JudicialNotice;
use Illuminate\Http\Request;

class JudicialNoticeController extends Controller
{
    public function index(Request $request)
    {
        // Obtén el valor de búsqueda
        $search = $request->input('search');

        // Filtra las notificaciones judiciales en base a la búsqueda
        $judicial_notices = JudicialNotice::where('tipo', 'LIKE', "%{$search}%")
            ->orWhere('details', 'LIKE', "%{$search}%")
            ->orderBy('publication_date', 'desc')
            ->paginate(10)
            ->appends(request()->input());

        // Cargar la vista con los resultados paginados
        return view('judicial_notices', compact('judicial_notices'));
    }
}
