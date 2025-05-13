<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dependency;
use App\Models\User;
use App\Models\Contrac;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDependencies = Dependency::count();
        $totalUsers = User::count();
        $totalContracts = Contrac::count();

        $completedContracts = Contrac::where('cutoff_date', '<=', now())->count();
        $contractsInExecution = Contrac::where('cutoff_date', '>', now())->count();

        return view('dashboard', compact(
            'totalDependencies',
            'totalUsers',
            'totalContracts',
            'completedContracts',
            'contractsInExecution'
        ));
    }
}