<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\Cargo;

class GabineteController extends Controller
{
    public function index($cargoTipo)
    {
        // Busca el cargo utilizando el nombre exacto en la base de datos
        $cargo = Cargo::where('name', $cargoTipo)->first();

        if (!$cargo) {
            // Si no se encuentra el cargo, muestra un mensaje de error en la vista
            return view('gabinete.index', [
                'funcionarios' => collect([]), // Colección vacía si no se encuentra el cargo
                'cargoTipo' => ucfirst($cargoTipo),
                'mensaje' => "No se encontró el cargo especificado: $cargoTipo. Asegúrate de que el nombre es correcto en la base de datos."
            ]);
        }

        // Consulta los funcionarios con el cargo especificado
        $funcionarios = Funcionario::where('cargo_id', $cargo->id)
                                    ->with(['cargo', 'area', 'dependencia'])
                                    ->get();

        return view('gabinete.index', compact('funcionarios', 'cargoTipo'));
    }

    public function show($cargoTipo, $id)
    {
        // Buscar el funcionario específico por su ID y cargar relaciones
        $funcionario = Funcionario::with(['cargo', 'area', 'dependencia'])->find($id);

        if (!$funcionario) {
            return redirect()->route('gabinete.index', $cargoTipo)->with('error', 'Funcionario no encontrado');
        }

        return view('gabinete.show', compact('funcionario', 'cargoTipo'));
    }
}
