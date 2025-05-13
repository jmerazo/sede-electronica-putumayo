<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contractor;
use App\Models\PlantOfficial;

class GovermentController extends Controller
{
    // Governor
    public function governorIndex($typeCharge)
    {
        $governor = PlantOfficial::where('charge', $typeCharge)->get();

        if ($governor->isEmpty()) {
            return view('goverment.governor', [
                'governor' => collect([]),
                'typeCharge' => ucfirst($typeCharge),
                'message' => "No se encontraron funcionarios para el cargo especificado: $typeCharge. Asegúrate de que el nombre es correcto en la base de datos."
            ]);
        }

        return view('goverment.governor', compact('governor', 'typeCharge'));
    }

    public function governorShow($typeCharge, $id)
    {
        $governor = PlantOfficial::find($id);

        if (!$governor) {
            return redirect()->route('cabinet.index', $typeCharge)->with('error', 'Funcionario no encontrado');
        }

        return view('goverment.governor', compact('governor', 'typeCharge'));
    }
}