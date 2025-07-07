<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class TareaController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Tarea::query()
            ->where('user_id', auth()->id());

        // Filtro por prioridad
        if ($request->filled('prioridad') && in_array($request->prioridad, ['alta', 'media', 'baja'])) {
            $query->where('prioridad', $request->prioridad);
        }

        // Filtro por estado
        if ($request->filled('estado')) {
            if ($request->estado === 'completada') {
                $query->where('completada', 1);
            } elseif ($request->estado === 'pendiente') {
                $query->where('completada', 0);
            }
        }

        $tareas = $query->get();

        return view('tareas.index', [
            'tareas' => $tareas,
            'prioridad' => $request->prioridad,
            'estado' => $request->estado,
        ]);
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
    public function completar(Tarea $tarea)
    {
        $this->authorize('update', $tarea);

        $tarea->update(['completada' => true]);

        return redirect()->route('tareas.index')->with('success', 'Tarea marcada como completada.');
    }

}
