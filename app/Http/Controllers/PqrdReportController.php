<?php

namespace App\Http\Controllers;

use App\Models\PqrdReport;
use Illuminate\Http\Request;

class PqrdReportController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $trimester = $request->input('trimester', 'Q3');

        // Filtrar los datos según el año y trimestre
        $pqrds_reports = PqrdReport::where('year', $year)
            ->where('trimester', $trimester)
            ->get();

        return view('pqrds_reports', compact('pqrds_reports', 'year', 'trimester'));
    }
}
