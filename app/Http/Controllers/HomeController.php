<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publications;
use App\Models\TypePublications;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener el tipo de publicación "Noticias"
        $typeNews = TypePublications::where('name', 'Noticias')->first();
        
        if (!$typeNews) {
            // Lanza un error si el tipo de publicación "Noticias" no existe
            abort(404, 'Tipo de publicación "Noticias" no encontrado');
        }

        // Consulta filtrada para obtener solo las publicaciones de tipo "Noticias" y con estado activo
        $publications = Publications::where('type_id', $typeNews->id)
                                    ->where('state', 1)
                                    ->with('type')
                                    ->orderBy('date', 'desc')
                                    ->paginate(5); // Ajusta la paginación según tus necesidades

        // Mostrar el resultado para verificarlo
        //Log::info('Publicaciones de tipo Noticias:', ['publications' => $publications->toArray()]);

        return view('home', compact('publications'));
    }
}
