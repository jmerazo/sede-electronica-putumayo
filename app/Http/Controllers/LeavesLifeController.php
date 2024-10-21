<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeavesLifeController extends Controller
{
    public function index()
    {
        return view('leaves_life');
    }
}
