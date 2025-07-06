@extends('layouts.app')

@section('content')
<div class="container mx-auto text-center p-6">
    <h1 class="text-3xl font-bold mb-4">Temporizador Pomodoro</h1>

    <div class="text-6xl font-mono mb-4" id="timer">25:00</div>

    <div class="flex justify-center space-x-4">
        <button class="bg-green-500 text-white px-4 py-2 rounded shadow" onclick="startTimer()">Iniciar</button>
        <button class="bg-red-500 text-white px-4 py-2 rounded shadow" onclick="stopTimer()">Detener</button>
        <button class="bg-blue-500 text-white px-4 py-2 rounded shadow" onclick="resetTimer()">Reiniciar</button>
    </div>

    <div class="mt-6">
        <label for="musica" class="block mb-2">Música de fondo (YouTube/Spotify)</label>
        <input type="text" id="musica" placeholder="Pega tu enlace aquí..." class="border rounded p-2 w-1/2 shadow">
    </div>
</div>

<script>
let duration = 25 * 60;
let timerInterval;

function updateTimer() {
    const minutes = Math.floor(duration / 60).toString().padStart(2, '0');
    const seconds = (duration % 60).toString().padStart(2, '0');
    document.getElementById('timer').innerText = `${minutes}:${seconds}`;
}

function startTimer() {
    if (!timerInterval) {
        timerInterval = setInterval(() => {
            if (duration > 0) {
                duration--;
                updateTimer();
            } else {
                clearInterval(timerInterval);
                timerInterval = null;
                alert('Pomodoro terminado');
            }
        }, 1000);
    }
}

function stopTimer() {
    clearInterval(timerInterval);
    timerInterval = null;
}

function resetTimer() {
    stopTimer();
    duration = 25 * 60;
    updateTimer();
}

updateTimer();
</script>
@endsection
