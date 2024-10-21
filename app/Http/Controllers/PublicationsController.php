<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publications;
use App\Models\TypePublications;

class PublicationsController extends Controller
{
    public function index(Request $request, $typeFilter = null)
    {
        $query = Publications::with('type'); // Agrega la relación aquí

        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->has('type') && !empty($request->type)) {
            $query->where('type_id', $request->type);
        } elseif ($typeFilter) {
            $query->where('type_id', $typeFilter);
        }

        $publications = $query->orderBy('date', 'desc')->paginate(10);
        $types = TypePublications::all();

        return view('publications', compact('publications', 'types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de la imagen
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/publications', 'public'); // Guarda en storage/app/public/images/publications
        }

        Publications::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $path, // Guarda la ruta en la base de datos
            'type_id' => $request->type_id,
            'state' => $request->state,
            'date' => $request->date,
        ]);

        return redirect()->back()->with('success', 'Publicación creada con éxito.');
    }

    public function update(Request $request, $id)
    {
        $publication = Publications::findOrFail($id);

        if ($request->hasFile('image')) {
            // Elimina la imagen anterior si existe
            if ($publication->image && file_exists(storage_path('app/public/' . $publication->image))) {
                unlink(storage_path('app/public/' . $publication->image));
            }

            // Guarda la nueva imagen
            $path = $request->file('image')->store('images/publications', 'public');
            $publication->image = $path;
        }

        $publication->title = $request->title;
        $publication->description = $request->description;
        $publication->save();

        return redirect()->back()->with('success', 'Publicación actualizada con éxito.');
    }

    public function destroy($id)
    {
        $publication = Publications::findOrFail($id);

        // Elimina la imagen si existe
        if ($publication->image && file_exists(storage_path('app/public/' . $publication->image))) {
            unlink(storage_path('app/public/' . $publication->image));
        }

        $publication->delete();

        return redirect()->back()->with('success', 'Publicación eliminada con éxito.');
    }
}