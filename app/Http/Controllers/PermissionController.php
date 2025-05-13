<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::paginate(15);
        return view('permissions.index', compact('permissions'));
    }

    public function show(Request $request, $id)
    {
        $permission = Permission::find($id);
        if (!$permission) {
            return response()->json(['message' => 'Permiso no encontrado'], 404);
        }
        return view('permissions.show', compact('permission'));
    }

    public function create()
    {
        return view('dashboard.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:40'
        ]);

        $permission = Permission::create($request->all());

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Permiso creado con éxito',
                'area' => $permission
            ]);
        }

        return redirect()->route('dashboard.permissions.index')->with('success', 'Permiso creado con éxito');
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return response()->json($permission);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:40',
        ]);

        $permission = Permission::findOrFail($id);
        $permission->update($request->all());

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Permiso actualizado con éxito',
                'area' => $permission
            ]);
        }

        return redirect()->route('dashboard.permissions.index')->with('success', 'Permiso actualizado con éxito');
    }

    public function destroy(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return response()->json(['message' => 'Permiso eliminado con éxito'], 200);
    }
}