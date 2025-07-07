<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">
    <header class="bg-black text-white p-4 shadow">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold">
                <a href="{{ route('dashboard') }}">TimeUp</a>
            </h1>
            <nav class="space-x-4 flex items-center gap-4">
                <a href="{{ route('tareas.index') }}" class="hover:underline">Tareas</a>
                <a href="{{ route('calendar.index') }}" class="hover:underline">Calendario</a>
                <a href="{{ url('/pomodoro') }}" class="hover:underline">Pomodoro</a>

                <span class="text-gray-600"> {{ Auth::user()->name }}</span>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button class="hover:underline">Salir</button>
                </form>
            </nav>

        </div>
    </header>

    <main class="container mx-auto p-4">
        @yield('content')
    </main>
</body>

</html>