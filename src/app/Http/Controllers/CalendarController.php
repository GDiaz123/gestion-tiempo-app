<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CalendarController extends Controller
{
    public function index()
    {
        $eventos = Evento::all();
        return view('calendar.index', compact('eventos'));
    }

    public function store(Request $request)
    {
        $evento = Evento::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'start_datetime' => "{$request->date} {$request->start_time}",
            'end_datetime' => "{$request->date} {$request->end_time}",
        ]);

        // Aquí puedes enviar el correo programado usando queue
        // Mail::to(auth()->user()->email)->later(...)

        return redirect()->route('calendar')->with('success', 'Evento creado');
    }
}
