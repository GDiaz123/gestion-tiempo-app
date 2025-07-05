<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    <header class="bg-blue-600 text-white p-4 shadow">
        <div class="container mx-auto flex justify-between">
            <h1 class="text-xl font-bold">
                <a href="{{ route('dashboard') }}">TimeUp</a>
            </h1>
            <nav>
                <a href="{{ route('tareas.index') }}" class="px-2">Tareas</a>
                <a href="{{ route('calendar') }}" class="px-2">Calendario</a>
                <a href="{{ url('/pomodoro') }}" class="px-2">Pomodoro</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button class="px-2">Salir</button>
                </form>
            </nav>
        </div>
    </header>

    <main class="container mx-auto p-4">
        @yield('content')
    </main>

</body>
</html>
