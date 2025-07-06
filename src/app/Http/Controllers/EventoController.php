<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::all();
        return view('calendar.index', compact('eventos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        Evento::create($request->only('title', 'date', 'start_time', 'end_time'));

        return redirect()->route('eventos.index')->with('success', 'Evento creado');
    }
}
