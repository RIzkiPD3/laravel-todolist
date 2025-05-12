<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->tasks()->latest()->take(5)->get();
        return view('dashboard', compact('tasks'));
    }
}
