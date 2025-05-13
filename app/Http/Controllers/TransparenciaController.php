<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transparency;

class TransparenciaController extends Controller
{
    public function index()
    {
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
        $seccionData = Transparency::where('tipo', 'seccion')->find($id);
        if (!$seccionData) {
            abort(404);
        }
        $subElementos = Transparency::where('tipo', 'subelemento')
                                     ->where('id_padre', $seccionData->id)
                                     ->orderBy('orden')
                                     ->get();

        return view('transparencia.show', compact('seccionData', 'subElementos'));
    }
}