<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilsController extends Controller
{
    public function index()
    {
        return view('transparencia.subelements.resume');
    }
}