<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MicrositioController extends Controller
{
    public function index()
    {
        return view('micrositios.micrositio1.index');
    }

    public function about()
    {
        return view('micrositios.micrositio1.about');
    }

    public function contact()
    {
        return view('micrositios.micrositio1.contact');
    }
}