@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex items-center mb-6">
        <a href="{{ route('tareas.index') }}" class="text-blue-600 hover:underline flex items-center">
            ← Volver a mis tareas
        </a>
    </div>

    <h1 class="text-2xl font-bold mb-4">Agregar Nueva Tarea</h1>

    <form method="POST" action="{{ route('tareas.store') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block">Título</label>
            <input type="text" name="titulo" class="w-full border rounded p-2 shadow" required>
        </div>
        <div>
            <label class="block">Descripción</label>
            <textarea name="descripcion" rows="3" class="w-full border rounded p-2 shadow"></textarea>
        </div>
        <div class="flex space-x-4">
            <div>
                <label class="block">Prioridad</label>
                <select name="prioridad" class="w-full border rounded p-2 shadow">
                    <option value="baja">Baja</option>
                    <option value="media">Media</option>
                    <option value="alta">Alta</option>
                </select>
            </div>
            <div>
                <label class="block">Fecha límite</label>
                <input type="date" name="fecha_limite" class="w-full border rounded p-2 shadow">
            </div>
        </div>
        <button type="submit" class="bg-black text-white px-4 py-2 rounded shadow hover:bg-gray-800">Guardar</button>
    </form>
</div>
@endsection
