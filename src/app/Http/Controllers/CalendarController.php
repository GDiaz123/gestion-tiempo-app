<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el mes del request o usar el mes actual
        $month = $request->input('month');
        $currentDate = $month ? Carbon::parse($month) : Carbon::now();
        
        // Validar que la fecha sea correcta
        if (!$currentDate->isValid()) {
            $currentDate = Carbon::now();
        }

        // Obtener el rango del mes
        $startDate = $currentDate->copy()->startOfMonth();
        $endDate = $currentDate->copy()->endOfMonth();

        // Obtener eventos para el mes visible
        $eventos = Evento::where('user_id', auth()->id())
                    ->where(function($query) use ($startDate, $endDate) {
                        $query->whereBetween('start_datetime', [$startDate, $endDate])
                              ->orWhereBetween('end_datetime', [$startDate, $endDate]);
                    })
                    ->get()
                    ->map(function($evento) {
                        $evento->date = Carbon::parse($evento->start_datetime)->toDateString();
                        return $evento;
                    });

        return view('calendar.index', [
            'eventos' => $eventos,
            'currentDate' => $currentDate,
            'currentMonth' => $currentDate->format('Y-m'),
            'daysInMonth' => $currentDate->daysInMonth,
            'startDayOfWeek' => $currentDate->copy()->startOfMonth()->dayOfWeekIso
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'important' => 'nullable|boolean'
        ]);

        Evento::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'start_datetime' => "{$validated['date']} {$validated['start_time']}",
            'end_datetime' => $validated['end_time'] ? "{$validated['date']} {$validated['end_time']}" : null,
            'type' => $request->boolean('important') ? 'important' : 'normal'

        ]);

        return redirect()->route('calendar.index')
                         ->with('success', 'Evento creado correctamente');
    }
}