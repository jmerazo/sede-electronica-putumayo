<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submodule;
use App\Models\User;

class SubmoduleController extends Controller
{
    public function index()
    {
        $submodules = Submodule::all(); 
        return view('submodules.index', compact('submodules'));
    }

    public function show(Request $request, $id)
    {
        $submodule = Submodule::find($id);
        if (!$submodule) {
            return response()->json(['message' => 'Submodulo no encontrado'], 404);
        }
        return view('submodules.show', compact('submodule'));
    }

    public function create()
    {
        return view('dashboard.submodules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'route' => 'required|string|max:100',
            'icon' => 'nullable|file|mimes:svg|max:2048',
        ]);

        $submodule = new Submodule();
        $submodule->module_id = $request->module_id;
        $submodule->name = $request->name;
        $submodule->route = $request->route;

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');

            // Validar que el archivo sea SVG
            if ($file->getClientOriginalExtension() !== 'svg') {
                return response()->json(['error' => 'El archivo debe ser un SVG'], 422);
            }

            // Guardar en la carpeta public/icon/
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('icon'), $filename);

            // Guardar solo el nombre en la base de datos
            $submodule->icon = $filename;
        } else {
            return response()->json(['error' => 'El icono es obligatorio'], 422);
        }

        $submodule->save();

        return response()->json([
            'message' => 'Submódulo creado con éxito',
            'module' => $submodule
        ]);
    }

    public function edit($id)
    {
        $submodule = Submodule::findOrFail($id);
        return response()->json($submodule);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:40',
            'route' => 'required|string|max:100',
            'icon' => 'required|string|max:255',
        ]);

        $submodule = Submodule::findOrFail($id);

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');

            if ($file->getClientOriginalExtension() !== 'svg') {
                return response()->json(['error' => 'El archivo debe ser un SVG'], 422);
            }

            if ($file->getSize() > 2048 * 1024) { // 2MB
                return response()->json(['error' => 'El archivo no debe superar los 2MB'], 422);
            }

            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('icon'), $filename);

            $submodule->icon = 'icon/' . $filename;
        }

        $submodule->name = $request->name;
        $submodule->route = $request->route;
        $submodule->save();

        return response()->json([
            'message' => 'Submódulo actualizado con éxito',
            'module' => $submodule
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $submodule = Submodule::findOrFail($id);
        $submodule->delete();

        return response()->json(['message' => 'Submodulo eliminado con éxito'], 200);
    }

    public function getSubmodulesByModule($module_id)
    {
        $submodules = Submodule::where('module_id', $module_id)->get();
        return response()->json($submodules);
    }

    public function getUserSubmodules($userId)
    {
        $user = User::with('modulePermissions')->find($userId);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $submodules = $user->modulePermissions->pluck('submodule_id')->unique();

        return response()->json([
            'submodules' => $submodules
        ]);
    }
}