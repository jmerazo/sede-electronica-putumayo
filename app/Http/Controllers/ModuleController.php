<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{
    public function index()
    {
        //$modules = Module::paginate(15);
        $modulesAdmin = Module::all(); 
        //dd(get_class($modules), $modules);
        //dd($modules->count(), $modules->toArray()); 
        return view('modules.index', compact('modulesAdmin'));
    }

    public function show(Request $request, $id)
    {
        $module = Module::find($id);
        if (!$module) {
            return response()->json(['message' => 'Modulo no encontrado'], 404);
        }
        return view('modules.show', compact('module'));
    }

    public function create()
    {
        return view('dashboard.modules.create');
    }

    public function store(Request $request)
    {
        // Validar los datos sin validar el archivo como string
        $request->validate([
            'name' => 'required|string|max:100',
            'route' => 'required|string|max:100',
            'icon' => 'nullable|file|mimes:svg|max:2048', // Ahora validamos como archivo SVG
        ]);

        $module = new Module();
        $module->name = $request->name;
        $module->route = $request->route;

        // Si se sube un archivo, lo guardamos
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
            $module->icon = $filename;
        } else {
            return response()->json(['error' => 'El icono es obligatorio'], 422);
        }

        $module->save();

        return response()->json([
            'message' => 'Módulo creado con éxito',
            'module' => $module
        ]);
    }

    public function edit($id)
    {
        $module = Module::findOrFail($id);
        return response()->json($module);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:40',
            'route' => 'required|string|max:100',
            'icon' => 'required|string|max:255',
        ]);

        $module = Module::findOrFail($id);

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

            $module->icon = 'icon/' . $filename;
        }

        $module->name = $request->name;
        $module->route = $request->route;
        $module->save();

        return response()->json([
            'message' => 'Módulo actualizado con éxito',
            'module' => $module
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $module = Module::findOrFail($id);
        $module->delete();

        return response()->json(['message' => 'Modulo eliminado con éxito'], 200);
    }
}