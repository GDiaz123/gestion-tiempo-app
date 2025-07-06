@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Mis tareas</h1>
        <a href="{{ route('tareas.create') }}" class="bg-black text-white px-4 py-2 rounded shadow hover:bg-gray-800">
            Agregar tarea
        </a>
    </div>

    <div class="flex space-x-4 mb-6">
        <select class="border rounded p-2 shadow w-1/3">
            <option>Todas las prioridades</option>
            <option>Alta</option>
            <option>Media</option>
            <option>Baja</option>
        </select>
        <select class="border rounded p-2 shadow w-1/3">
            <option>Todos los Estados</option>
            <option>Pendiente</option>
            <option>En progreso</option>
            <option>Completada</option>
        </select>
        <input type="date" class="border rounded p-2 shadow w-1/3">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($tareas as $tarea)
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-xl font-bold">{{ $tarea->titulo }}</h2>
            <p class="text-gray-600 mb-2">{{ $tarea->descripcion }}</p>

            <div class="flex flex-wrap gap-2 mb-2">
                <span class="text-sm px-2 py-1 rounded 
                    @if($tarea->prioridad == 'alta') bg-red-500 text-white 
                    @elseif($tarea->prioridad == 'media') bg-yellow-500 text-white 
                    @else bg-green-500 text-white @endif">
                    Prioridad: {{ ucfirst($tarea->prioridad) }}
                </span>
                <span class="text-sm px-2 py-1 rounded bg-blue-500 text-white">
                    Estado: Pendiente
                </span>
                @if($tarea->fecha_limite)
                <span class="text-sm px-2 py-1 rounded bg-gray-300 text-black">
                    Fecha Límite: {{ \Carbon\Carbon::parse($tarea->fecha_limite)->format('d \d\e F \d\e Y') }}
                </span>
                @endif
            </div>

            <div class="flex justify-between space-x-2">
                <a href="{{ route('tareas.edit', $tarea->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded shadow hover:bg-blue-600">Editar</a>
                <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded shadow hover:bg-red-600">Eliminar</button>
                </form>
                <form action="#" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded shadow hover:bg-green-600">Marcar Completada</button>
                </form>
            </div>
        </div>
        @empty
        <p class="text-gray-600">No tienes tareas aún. ¡Crea tu primera tarea!</p>
        @endforelse
    </div>
</div>
@endsection
