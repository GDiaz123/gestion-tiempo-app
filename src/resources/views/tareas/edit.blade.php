@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-md p-4 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Editar Tarea</h1>

    <form method="POST" action="{{ route('tareas.update', $tarea) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block">Título</label>
            <input type="text" name="titulo" value="{{ old('titulo', $tarea->titulo) }}"
                   class="w-full border rounded p-2 shadow" required>
        </div>

        <div class="mb-4">
            <label class="block">Descripción</label>
            <textarea name="descripcion" rows="3"
                      class="w-full border rounded p-2 shadow">{{ old('descripcion', $tarea->descripcion) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block">Prioridad</label>
            <select name="prioridad" class="w-full border rounded p-2 shadow">
                @foreach(['baja', 'media', 'alta'] as $prioridad)
                    <option value="{{ $prioridad }}" {{ $tarea->prioridad === $prioridad ? 'selected' : '' }}>
                        {{ ucfirst($prioridad) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block">Fecha límite</label>
            <input type="date" name="fecha_limite"
                   value="{{ old('fecha_limite', \Carbon\Carbon::parse($tarea->fecha_limite)->format('Y-m-d')) }}"
                   class="w-full border rounded p-2 shadow">
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded shadow hover:bg-indigo-700">
                Actualizar
            </button>
        </div>
    </form>
</div>
@endsection
