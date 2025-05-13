<?php
namespace App\Http\Controllers;

use App\Models\Dependency;
use Illuminate\Http\Request;

class DependencyController extends Controller
{
    public function indexNavbar()
    {
        $dependencies = Dependency::with('subdependencies')->get();
        return view('navbar', compact('dependencies'));
    }

    public function index()
    {
        $dependencies = Dependency::paginate(15);
        return view('dependencies.index', compact('dependencies'));
    }

    public function show(Request $request, $id)
    {
        $dependency = Dependency::find($id);
        if (!$dependency) {
            return response()->json(['message' => 'Dependencia no encontrada'], 404);
        }
        return view('dependencies.show', compact('dependency'));
    }

    public function create()
    {
        return view('dashboard.dependencies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'shortname' => 'required|string|max:250'
        ]);

        $dependency = Dependency::create($request->all());

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Dependencia creada con éxito',
                'dependency' => $dependency
            ]);
        }

        return redirect()->route('dashboard.dependencies.index')->with('success', 'Dependencia creada con éxito');
    }

    public function edit($id)
    {
        $dependency = Dependency::findOrFail($id);
        return response()->json($dependency);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'shortname' => 'required|string|max:250'
        ]);

        $dependency = Dependency::findOrFail($id);
        $dependency->update($request->all());

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Área actualizada con éxito',
                'dependency' => $dependency
            ]);
        }

        return redirect()->route('dashboard.dependencies.index')->with('success', 'Dependencia actualizada con éxito');
    }

    public function destroy(Request $request, $id)
    {
        $dependency = Dependency::findOrFail($id);
        $dependency->delete();
        return response()->json(['message' => 'Dependencia eliminada con éxito'], 200);
    }

    public function getDependencies()
    {
        return response()->json(Dependency::select('id', 'name')->get());
    }

    public function indexPublic(Request $request)
    {
        $search = $request->input('search');
        $directory = Dependency::select('name', 'description', 'cellphone', 'email')
                        ->when($search, function ($query, $search) {
                            return $query->where('name', 'like', "%{$search}%");
                        })
                        ->orderBy('name')
                        ->paginate(10);
        return view('transparencia.subelements.directory', compact('directory', 'search'));
    }
}