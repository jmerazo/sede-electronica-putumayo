<?php

namespace App\Http\Controllers;

use App\Models\Formality;
use Illuminate\Http\Request;

class FormalityController extends Controller
{
    public function index()
    {
        $formalities = Formality::paginate(5);

        foreach ($formalities as $formality) {
            // Limpiar caracteres de control y decodificar el JSON si es válido
            if (is_string($formality->tipo)) {
                $cleanedTipo = preg_replace('/\r\n|\r|\n/', '', $formality->tipo); // Eliminar saltos de línea
                $formality->tipo = json_decode($cleanedTipo, true);
            }
        }

        return view('formalities', compact('formalities'));
    }
}