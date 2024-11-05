<?php

namespace App\Http\Controllers;

use App\Models\Subsubmenu;
use Illuminate\Http\Request;

class SubsubmenuController extends Controller
{
    public function show($id)
    {
        // Obtener el sub-submenú específico
        $subsubmenu = Subsubmenu::with('submenu.menu')->findOrFail($id);

        // Construir el breadcrumb con base en las relaciones
        $breadcrumbItems = [
            ['url' => route('home'), 'label' => 'Inicio'],
            ['url' => route('menu.show', $subsubmenu->submenu->menu->id), 'label' => $subsubmenu->submenu->menu->name],
            ['url' => route('submenu.show', $subsubmenu->submenu->id), 'label' => $subsubmenu->submenu->name],
            ['url' => route('subsubmenu.show', $subsubmenu->id), 'label' => $subsubmenu->name],
        ];

        // Pasar datos a la vista
        return view('subsubmenu.show', compact('subsubmenu', 'breadcrumbItems'));
    }
}