<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;

class CalendarController extends Controller
{
    public function index()
    {
        $tareas = Tarea::where('user_id', auth()->id())->get();

        $events = $tareas->map(function ($tarea) {
            return [
                'title' => $tarea->titulo,
                'start' => $tarea->fecha_limite,
                'url'   => route('tareas.show', $tarea),
            ];
        });

        return view('calendar.index', compact('events'));
    }
}
