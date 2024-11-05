<?php

namespace App\Http\Controllers;

use App\Models\Execution;
use Illuminate\Http\Request;

class ExecutionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $executions = Execution::when($search, function ($query, $search) {
            return $query->where('contract_number', 'like', "%{$search}%");
        })->paginate(10);

        return view('execution', compact('executions'));
    }
}
