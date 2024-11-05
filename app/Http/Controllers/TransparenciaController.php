<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transparency;

class TransparenciaController extends Controller
{
    public function index()
    {
        // Obtener todas las secciones usando el modelo Transparency
        $secciones = Transparency::where('tipo', 'seccion')
                                 ->orderBy('orden')
                                 ->get();

        $breadcrumbItems = [
            ['url' => route('home'), 'label' => 'Inicio'],
            ['url' => route('transparencia.index'), 'label' => 'Transparencia'],
        ];

        return view('transparencia.index', compact('secciones', 'breadcrumbItems'));
    }

    public function show($id)
    {
        // Obtener la sección específica
        $seccionData = Transparency::where('tipo', 'seccion')->find($id);

        // Verificar si $seccionData existe
        if (!$seccionData) {
            abort(404);
        }

        // Obtener los subelementos de esta sección
        $subElementos = Transparency::where('tipo', 'subelemento')
                                     ->where('id_padre', $seccionData->id)
                                     ->orderBy('orden')
                                     ->get();

        return view('transparencia.show', compact('seccionData', 'subElementos'));
    }
}