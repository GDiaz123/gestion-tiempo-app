@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Nueva Tarea</h2>

<form action="{{ route('tareas.store') }}" method="POST" class="bg-white p-4 rounded shadow">
    @csrf
    <div class="mb-4">
        <label class="block">Título</label>
        <input type="text" name="titulo" class="border p-2 w-full">
    </div>
    <div class="mb-4">
        <label class="block">Descripción</label>
        <textarea name="descripcion" class="border p-2 w-full"></textarea>
    </div>
    <div class="mb-4">
        <label class="block">Prioridad</label>
        <select name="prioridad" class="border p-2 w-full">
            <option value="baja">Baja</option>
            <option value="media" selected>Media</option>
            <option value="alta">Alta</option>
        </select>
    </div>
    <div class="mb-4">
        <label class="block">Fecha Límite</label>
        <input type="date" name="fecha_limite" class="border p-2 w-full">
    </div>
    <button class="bg-blue-500 text-white px-4 py-2 rounded">Guardar</button>
</form>
@endsection
