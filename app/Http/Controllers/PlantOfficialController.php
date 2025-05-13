<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlantOfficial;
use App\Models\Contractor;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PlantOfficialExport;

class PlantOfficialController extends Controller
{
    public function index(Request $request)
    {
        $query = PlantOfficial::query();
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $field = $request->category ?? 'fullname';

            $allowedFields = ['document_number', 'fullname', 'dependency'];
            if (in_array($field, $allowedFields)) {
                $query->where($field, 'LIKE', "%$search%");
            } else {
                $query->where(function ($q) use ($search) {
                    $q->where('fullname', 'LIKE', "%$search%")
                    ->orWhere('document_number', 'LIKE', "%$search%")
                    ->orWhere('dependency', 'LIKE', "%$search%");
                });
            }
        }

        $plantofficial = $query->paginate(15)->withQueryString();
        return view('publication.plantofficials', compact('plantofficial'));
    }

    public function show(Request $request, $id)
    {
        $plantofficial = PlantOfficial::find($id);
        if (!$plantofficial) {
            return response()->json(['message' => 'Funcionario no encontrado.'], 404);
        }
        return view('plantofficials.show', compact('plantofficial'));
    }

    public function create()
    {
        return view('dashboard.plantofficials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullname'     => 'required|string|max:100'
        ]);
        $plantofficial = PlantOfficial::create($request->all());
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Funcionario creado con éxito',
                'plantofficial' => $plantofficial
            ]);
        }

        return redirect()->route('dashboard.plantofficials.index')->with('success', 'Funcionario creado con éxito');
    }

    public function edit($id)
    {
        $plantofficial = PlantOfficial::findOrFail($id);
        return response()->json($plantofficial);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fullname'     => 'required|string|max:100'
        ]);

        $plantofficial = PlantOfficial::findOrFail($id);
        $plantofficial->update($request->all());

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Funcionario actualizado con éxito',
                'plantofficial' => $plantofficial
            ]);
        }

        return redirect()->route('dashboard.plantofficials.index')->with('success', 'Funcionario actualizado con éxito');
    }

    public function destroy(Request $request, $id)
    {
        $plantofficial = PlantOfficial::findOrFail($id);
        $plantofficial->delete();
        return response()->json(['message' => 'Funcionario eliminado con éxito'], 200);
    }

    public function exportPlantOfficial(Request $request)
    {
        $year = $request->input('year_plantofficial');
        $month = $request->input('month_plantofficial');

        if (!$year || !$month) {
            return redirect()->back()->with('error', 'Debe seleccionar año y mes.');
        }

        return Excel::download(new PlantOfficialExport($year, $month), "Plant_Officials_{$month}_{$year}.xlsx");
    }

    public function directory(Request $request)
    {
        $search = $request->input('search');
        $plantofficials = PlantOfficial::when($search, function ($query, $search) {
                            $query->where('fullname', 'like', "%{$search}%")
                                  ->orWhere('charge', 'like', "%{$search}%")
                                  ->orWhere('dependency', 'like', "%{$search}%");
                        })
                        ->orderBy('fullname')
                        ->paginate(10);
    
        $contractors = Contractor::when($search, function ($query, $search) {
                            $query->where('contractor', 'like', "%{$search}%")
                                  ->orWhere('contract_number', 'like', "%{$search}%")
                                  ->orWhere('object', 'like', "%{$search}%");
                        })
                        ->orderBy('contractor')
                        ->paginate(10);
    
        $sigepInfo = "
                Art. 9 Ley 1712 de 2014 en concordancia con Decreto 1081 de 2015 Art. 2.1.1.2.1.5.
                Directorio de Información de servidores públicos, empleados y contratistas.
                PARÁGRAFO 1. Para las entidades u organismos públicos, el requisito se entenderá cumplido con 
                publicación de la información que contiene el directorio en el Sistema de Gestión del Empleo Público (SIGEP),
                de que trata el artículo 18 de la Ley 909 de 2004 y las normas que la reglamentan.
                
                Ingrese al siguiente <a href='https://www.funcionpublica.gov.co/dafpIndexerBHV/hvSigep/index?find=FindNext&query=putumayo&dptoSeleccionado=&entidadSeleccionado=4415&munSeleccionado=&tipoAltaSeleccionado=&bloquearFiltroDptoSeleccionado=&bloquearFiltroEntidadSeleccionado=&bloquearFiltroMunSeleccionado=&bloquearFiltroTipoAltaSeleccionado='>Enlace</a> para consultar la información de cada uno de los servidores públicos y contratistas.";                   
    
        return view('transparencia.subelements.directory-active', compact('plantofficials', 'contractors', 'sigepInfo', 'search'));
    }
}