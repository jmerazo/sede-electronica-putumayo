<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\TypePublication;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $typeNews = TypePublication::where('name', 'Noticias')->first();
        
        if (!$typeNews) {
            abort(404, 'Tipo de publicación "Noticias" no encontrado');
        }

        $publications = Publication::where('type_id', $typeNews->id)
                                    ->where('state', 1)
                                    ->with('type')
                                    ->orderBy('date', 'desc')
                                    ->paginate(5);

        return view('home', compact('publications'));
    }
}
