<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Evento;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // app/Http/Controllers/DashboardController.php
    public function index()
    {
        return view('dashboard');
    }
}