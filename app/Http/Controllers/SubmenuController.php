<?php

namespace App\Http\Controllers;

use App\Models\Submenu;
use Illuminate\Http\Request;

class SubmenuController extends Controller
{
    public function show($id)
    {
        // Obtener el submenú específico
        $submenu = Submenu::with('menu', 'subsubmenus')->findOrFail($id);

        // Construir el breadcrumb con base en las relaciones
        $breadcrumbItems = [
            ['url' => route('home'), 'label' => 'Inicio'],
            ['url' => route('menu.show', $submenu->menu->id), 'label' => $submenu->menu->name],
            ['url' => route('submenu.show', $submenu->id), 'label' => $submenu->name],
        ];

        // Pasar datos a la vista
        return view('submenu.show', compact('submenu', 'breadcrumbItems'));
    }
}