<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\UserModulePermission;
use App\Models\User;
use App\Models\Module;
use App\Models\Submodule;
use App\Models\Permission;

class UserModulePermissionController extends Controller
{
    public function assignPermission(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permissions' => 'required|array',
            'permissions.*' => 'array', // cada submódulo tendrá un array de permisos
        ]);

        $created = [];

        foreach ($request->permissions as $submoduleId => $permissionIds) {
            // Validar: evitar claves inválidas
            if (!$submoduleId || !is_numeric($submoduleId)) {
                continue;
            }
        
            // Obtener el submódulo
            $submodule = Submodule::find($submoduleId);
            if (!$submodule) continue;
        
            foreach ($request->permissions as $key => $permissionIds) {
                // Si es por submódulo (formato clásico)
                if (is_numeric($key)) {
                    $submoduleId = $key;
                    $submodule = Submodule::find($submoduleId);
                    if (!$submodule) continue;
            
                    foreach ($permissionIds as $permissionId) {
                        if (!is_numeric($permissionId) || !$permissionId) continue;
            
                        UserModulePermission::updateOrCreate([
                            'user_id' => $request->user_id,
                            'module_id' => $submodule->module_id,
                            'submodule_id' => $submoduleId,
                            'permission_id' => $permissionId,
                        ]);
                    }
                }
            
                // Si es por módulo sin submódulo (nombre con "module_")
                elseif (str_starts_with($key, "module_")) {
                    $moduleId = (int) str_replace("module_", "", $key);
            
                    foreach ($permissionIds as $permissionId) {
                        if (!is_numeric($permissionId) || !$permissionId) continue;
            
                        UserModulePermission::updateOrCreate([
                            'user_id' => $request->user_id,
                            'module_id' => $moduleId,
                            'submodule_id' => null,
                            'permission_id' => $permissionId,
                        ]);
                    }
                }
            }                        
        }        

        return response()->json([
            'message' => 'Permisos asignados correctamente',
            'data' => $created
        ]);
    }

    public function getUserPermissions($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $permissionsRaw = UserModulePermission::with(['submodule.module', 'module'])
            ->where('user_id', $userId)
            ->get();

        // Permisos asignados (para checkboxes)
        $permissions = $permissionsRaw->map(function ($perm) {
            return [
                'submodule_id' => $perm->submodule_id,
                'module_id' => $perm->module_id,
                'permission_id' => $perm->permission_id,
            ];
        });

        // Submódulos con módulo
        $submodules = $permissionsRaw->whereNotNull('submodule_id')->map(function ($perm) {
            return [
                'id' => $perm->submodule->id,
                'name' => $perm->submodule->name,
                'module_id' => $perm->submodule->module->id,
                'module_name' => $perm->submodule->module->name,
            ];
        })->unique('id');

        // Módulos sin submódulos (permiso directo)
        $modulesDirect = $permissionsRaw->whereNull('submodule_id')->map(function ($perm) {
            return [
                'id' => $perm->module_id,
                'name' => $perm->module->name,
                'module_id' => $perm->module_id,
                'module_name' => $perm->module->name,
            ];
        })->unique('id');

        $all = $submodules->merge($modulesDirect)->unique(function ($item) {
            return $item['id'].'-'.$item['module_id'];
        })->values();

        return response()->json([
            'submodules' => $all,
            'permissions' => $permissions,
        ]);
    }

    public function revokePermission(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'module_id' => 'required|exists:modules,id',
            'submodule_id' => 'required|exists:submodules,id',
            'permission_id' => 'required|exists:permissions,id',
        ]);

        $deleted = UserModulePermission::where([
            'user_id' => $request->user_id,
            'module_id' => $request->module_id,
            'submodule_id' => $request->submodule_id,
            'permission_id' => $request->permission_id,
        ])->delete();

        if ($deleted) {
            return response()->json(['message' => 'Permiso revocado'], 200);
        } else {
            return response()->json(['message' => 'Permiso no encontrado'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'shortname' => 'required|string|max:250|email|unique:users,email',
            'password' => 'required|string|min:6',
            'module_id' => 'required|exists:modules,id',
            'submodule_id' => 'required|exists:submodules,id',
            'permission_id' => 'required|exists:permissions,id'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->shortname,
            'password' => bcrypt($request->password)
        ]);

        // Asignar permiso al usuario
        UserModulePermission::create([
            'user_id' => $user->id,
            'module_id' => $request->module_id,
            'submodule_id' => $request->submodule_id,
            'permission_id' => $request->permission_id,
        ]);

        return response()->json([
            'message' => 'Usuario creado con éxito y permiso asignado',
            'user' => $user
        ]);
    }

    public function syncPermissions(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permissions' => 'array',
        ]);

        $userId = $request->user_id;

        // Obtener todos los permisos actuales del usuario
        $current = UserModulePermission::where('user_id', $userId)->get();

        // Construir la nueva lista de permisos enviados
        $newPermissions = [];

        foreach ($request->permissions as $key => $permissionIds) {
            // Si la clave es tipo "module_1", significa que no tiene submódulo
            if (Str::startsWith($key, 'module_')) {
                $moduleId = (int) Str::after($key, 'module_');

                foreach ($permissionIds as $permissionId) {
                    $newPermissions[] = [
                        'user_id' => $userId,
                        'module_id' => $moduleId,
                        'submodule_id' => null,
                        'permission_id' => (int) $permissionId,
                    ];
                }
            } else {
                // Tiene submódulo asignado
                $submodule = Submodule::find($key);
                if (!$submodule) continue;

                foreach ($permissionIds as $permissionId) {
                    $newPermissions[] = [
                        'user_id' => $userId,
                        'module_id' => $submodule->module_id,
                        'submodule_id' => (int) $key,
                        'permission_id' => (int) $permissionId,
                    ];
                }
            }
        }

        // Eliminar los permisos que ya no están
        foreach ($current as $perm) {
            $exists = collect($newPermissions)->first(function ($new) use ($perm) {
                return $new['module_id'] == $perm->module_id &&
                    $new['submodule_id'] == $perm->submodule_id &&
                    $new['permission_id'] == $perm->permission_id;
            });

            if (!$exists) {
                $perm->delete();
            }
        }

        // Insertar o actualizar los nuevos permisos
        foreach ($newPermissions as $perm) {
            UserModulePermission::updateOrCreate($perm, []);
        }

        return response()->json([
            'message' => 'Permisos actualizados correctamente',
        ]);
    }

    public function syncModules(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'module_id' => 'required|exists:modules,id',
            'submodules' => 'array',
        ]);

        $userId = $request->user_id;
        $moduleId = $request->module_id;

        // Obtener los registros actuales del usuario para ese módulo
        $current = UserModulePermission::where('user_id', $userId)
            ->where('module_id', $moduleId)
            ->get();

        $newAssignments = [];

        // Si se seleccionaron submódulos, procesarlos
        if (!empty($request->submodules)) {
            foreach ($request->submodules as $subId) {
                $newAssignments[] = [
                    'user_id' => $userId,
                    'module_id' => $moduleId,
                    'submodule_id' => (int)$subId,
                    'permission_id' => null // aún sin permisos
                ];
            }
        } else {
            // Si no hay submódulos, es asignación directa de módulo
            $newAssignments[] = [
                'user_id' => $userId,
                'module_id' => $moduleId,
                'submodule_id' => null,
                'permission_id' => null
            ];
        }

        // Eliminar asignaciones que ya no estén
        foreach ($current as $entry) {
            $exists = collect($newAssignments)->first(function ($new) use ($entry) {
                return $entry->module_id == $new['module_id'] &&
                    $entry->submodule_id == $new['submodule_id'];
            });

            if (!$exists) {
                $entry->delete();
            }
        }

        // Insertar nuevas asignaciones
        foreach ($newAssignments as $assign) {
            UserModulePermission::updateOrCreate($assign, []);
        }

        return response()->json(['message' => 'Módulos/submódulos actualizados correctamente']);
    }
}