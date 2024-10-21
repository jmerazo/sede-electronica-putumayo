<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class CalendarController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('calendar', compact('events'));
    }

    public function fetchEvents(Request $request)
    {
        $events = Event::all();
        return response()->json($events);
    }
}

