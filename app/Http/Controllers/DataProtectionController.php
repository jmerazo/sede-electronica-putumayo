<?php

namespace App\Http\Controllers;

use App\Models\DataProtection;
use Illuminate\Http\Request;

class DataProtectionController extends Controller
{
    public function index()
    {
        // Obtener el primer registro de la política de datos
        $dataProtection = DataProtection::first();

        // Retornar la vista con la información de la política
        return view('data_protection', compact('dataProtection'));
    }
}
