@extends('layouts.app')

@section('content')
<div class="flex justify-between mb-4">
    <h2 class="text-2xl font-bold">Tus tareas</h2>
    <a href="{{ route('tareas.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Nueva tarea</a>
</div>

<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2">Título</th>
            <th class="p-2">Fecha límite</th>
            <th class="p-2">Prioridad</th>
            <th class="p-2">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tareas as $tarea)
        <tr class="border-b">
            <td class="p-2">{{ $tarea->titulo }}</td>
            <td class="p-2">{{ $tarea->fecha_limite }}</td>
            <td class="p-2">{{ ucfirst($tarea->prioridad) }}</td>
            <td class="p-2">
                <a href="{{ route('tareas.edit', $tarea) }}" class="text-blue-600">Editar</a>
                <form action="{{ route('tareas.destroy', $tarea) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button class="text-red-600 ml-2">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
