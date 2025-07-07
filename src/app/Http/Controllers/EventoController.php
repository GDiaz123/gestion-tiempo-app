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
        'start_time' => 'nullable',
        'end_time' => 'nullable',
    ]);

    Evento::create([
        'title' => $request->title,
        'date' => $request->date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'user_id' => auth()->id(),
    ]);

    return redirect()->route('calendar.index')->with('success', 'Evento agregado correctamente.');
    }
}