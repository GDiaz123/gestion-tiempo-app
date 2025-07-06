<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tareas = Tarea::where('user_id', auth()->id())->get();
        return view('tareas.index', compact('tareas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tareas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_limite' => 'nullable|date',
            'prioridad' => 'required|in:baja,media,alta',
        ]);

        Tarea::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_limite' => $request->fecha_limite,
            'prioridad' => $request->prioridad,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('tareas.index')->with('success', 'Tarea creada correctamente');
    }


    /**
     * Display the specified resource.
     */
    public function show(Tarea $tarea)
    {
        $this->authorize('view', $tarea);
        return view('tareas.show', compact('tarea'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarea $tarea)
    {
        $this->authorize('update', $tarea);
        return view('tareas.edit', compact('tarea'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarea $tarea)
    {
        $this->authorize('update', $tarea);

        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'nullable',
            'prioridad' => 'required|in:baja,media,alta',
            'fecha_limite' => 'nullable|date',
        ]);

        $tarea->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'prioridad' => $request->prioridad,
            'fecha_limite' => $request->fecha_limite,
        ]);

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarea $tarea)
    {
        $this->authorize('delete', $tarea);

        $tarea->delete();

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea eliminada correctamente');
    }

    public function calendar()
    {
        $events = Tarea::where('user_id', auth()->id())
            ->get()
            ->map(function ($tarea) {
                return [
                    'title' => $tarea->titulo,
                    'start' => $tarea->fecha_limite,
                ];
            });

        return view('calendar.index', ['events' => $events]);
    }
}
