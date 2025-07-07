@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Encabezado -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Panel Principal</h1>
        <div class="flex space-x-4">
            <a href="{{ route('tareas.create') }}" class="btn-primary">
                <i class="fas fa-plus mr-2"></i> Nueva Tarea
            </a>
            <a href="/pomodoro" class="btn-secondary">
                <i class="fas fa-clock mr-2"></i> Pomodoro
            </a>
        </div>
    </div>

    <!-- Tarjetas de Acceso Rápido -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Tarjeta Tareas -->
        <a href="{{ route('tareas.index') }}" class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500 hover:bg-blue-50 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Tareas</p>
                    <p class="text-2xl font-bold text-gray-800">Administrar</p>
                </div>
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-tasks fa-lg"></i>
                </div>
            </div>
        </a>

        <!-- Tarjeta Calendario -->
        <a href="{{ route('calendar.index') }}" class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500 hover:bg-green-50 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Calendario</p>
                    <p class="text-2xl font-bold text-gray-800">Eventos</p>
                </div>
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-calendar-day fa-lg"></i>
                </div>
            </div>
        </a>

        <!-- Tarjeta Pomodoro -->
        <a href="/pomodoro" class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500 hover:bg-purple-50 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Técnica</p>
                    <p class="text-2xl font-bold text-gray-800">Pomodoro</p>
                </div>
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-clock fa-lg"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Mensaje de Bienvenida -->
    <div class="bg-white rounded-lg shadow p-8 text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">¡Bienvenido a TimeUp!</h2>
        <p class="text-gray-600 mb-6">
            Gestiona tu tiempo eficientemente con nuestras herramientas.
        </p>
        <div class="flex justify-center space-x-4">
            <a href="{{ route('tareas.index') }}" class="btn-primary">
                Ver mis tareas
            </a>
            <a href="/pomodoro" class="btn-secondary">
                Usar Pomodoro
            </a>
        </div>
    </div>
</div>

@push('styles')
<style>
    .btn-primary {
        @apply px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center;
    }
    .btn-secondary {
        @apply px-4 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition flex items-center;
    }
</style>
@endpush
@endsection