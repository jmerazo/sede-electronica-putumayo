<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\SliderImage;

class SliderImageController extends Controller
{
    // Mostrar solo las imágenes activas ordenadas
    public function active()
    {
        $slider = SliderImage::where('status', 1)
            ->orderByDesc('order')
            ->get();

        return response()->json($slider);
    }

    // Mostrar todas las imágenes para administración
    public function manage()
    {
        $slider = SliderImage::orderByDesc('order')->paginate(20);
        return view('dashboard.slider.manage', compact('slider'));
    }

    // Cambiar el estado (activar/desactivar) de una imagen
    public function toggleStatus($id)
    {
        $slider = SliderImage::findOrFail($id);
        $slider->status = !$slider->status;
        $slider->save();

        return response()->json(['message' => 'Estado actualizado', 'status' => $slider->status]);
    }

    // Cambiar el orden de una imagen
    public function updateOrder(Request $request, $id)
    {
        $request->validate([
            'order' => 'required|integer'
        ]);

        $slider = SliderImage::findOrFail($id);
        $slider->order = $request->order;
        $slider->save();

        return response()->json(['message' => 'Orden actualizado', 'order' => $slider->order]);
    }

    public function index()
    {
        $slider = SliderImage::paginate(15);
        return view('administration.slider-images', compact('slider'));
    }

    public function show(Request $request, $id)
    {
        $slider = SliderImage::find($id);
        if (!$slider) {
            return response()->json(['message' => 'Imagen no encontrada'], 404);
        }
        return view('slider.show', compact('slider'));
    }

    public function create()
    {
        return view('dashboard.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:250',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/sliders'), $filename);
        }        

        $route = isset($filename) ? $filename : null;
    
        $slider = SliderImage::create([
            'title' => $request->title,
            'route' => $route,
            'link' => $request->link,
            'order' => SliderImage::max('order') + 1,
            'status' => 1,
            'site_id' => $request->site_id,
            'user_register_id' => $request->user_register_id,
        ]);
    
        return response()->json([
            'message' => 'Imagen creada con éxito',
            'slider' => $slider
        ]);
    }

    public function edit($id)
    {
        $slider = SliderImage::findOrFail($id);
        return response()->json($slider);
    }

    public function update(Request $request, $id)
    {
        $slider = SliderImage::findOrFail($id);

        $request->validate([
            'title' => 'nullable|string|max:250',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            $oldImagePath = public_path('img/sliders/' . $slider->route);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/sliders'), $filename);
            $slider->route = $filename;
        }

        $slider->title = $request->title;
        $slider->link = $request->link;
        $slider->order = $request->order ?? $slider->order;
        $slider->status = $request->status ?? $slider->status;
        $slider->site_id = $request->site_id ?? $slider->site_id;
        $slider->save();

        return response()->json([
            'message' => 'Imagen actualizada con éxito',
            'slider' => $slider
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $slider = SliderImage::findOrFail($id);

        $imagePath = public_path('img/sliders/' . $slider->route);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $slider->delete();

        return response()->json(['message' => 'Imagen eliminada con éxito'], 200);
    }
}