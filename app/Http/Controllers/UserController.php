<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Permission;
use App\Models\Submodule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(15);
        $permissions = Permission::all();
        $submodules = Submodule::all();
        return view('users.index', compact('users', 'permissions', 'submodules'));
    }

    public function show(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'shortname' => 'required|string|max:250'
        ]);

        $user = User::create($request->all());
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Usuario creado con éxito',
                'area' => $user
            ]);
        }

        return redirect()->route('dashboard.users.index')->with('success', 'Usuario creado con éxito');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'shortname' => 'required|string|max:250'
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Usuario actualizado con éxito',
                'area' => $user
            ]);
        }

        return redirect()->route('dashboard.users.index')->with('success', 'Usuario actualizado con éxito');
    }

    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'Usuario eliminado con éxito'], 200);
    }

    public function getSubmodulesByModule($module_id)
    {
        $submodules = Submodule::where('module_id', $module_id)->get();
        return response()->json($submodules);
    }

    public function getBossesArea()
    {
        $jefes = User::where('rol_id', 2)->select('id', 'name')->get();
        return response()->json($jefes);
    }
}