@extends('layouts.app')

@section('content')
<div class="container mx-auto text-center p-6 max-w-md bg-white rounded-xl shadow-lg">
    <h1 class="text-3xl font-bold mb-6 text-indigo-700">Temporizador Pomodoro</h1>

    <!-- Timer display -->
    <div class="text-7xl font-mono mb-8 text-gray-800 bg-indigo-50 p-6 rounded-full border-4 border-indigo-200">
        <span id="timer">25:00</span>
    </div>

    <!-- Control buttons -->
    <div class="flex justify-center space-x-4 mb-8">
        <button class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-full shadow-lg transition transform hover:scale-105" onclick="startTimer()">
            <i class="fas fa-play mr-2"></i>Iniciar
        </button>
        <button class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-full shadow-lg transition transform hover:scale-105" onclick="stopTimer()">
            <i class="fas fa-stop mr-2"></i>Detener
        </button>
        <button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-full shadow-lg transition transform hover:scale-105" onclick="resetTimer()">
            <i class="fas fa-redo mr-2"></i>Reiniciar
        </button>
    </div>

    <!-- Music platforms -->
    <div class="mt-6">
        <p class="text-gray-600 mb-3">Escuchar en:</p>
        <div class="flex justify-center space-x-6">
            <a href="https://open.spotify.com" target="_blank" class="text-green-500 hover:text-green-600 hover:scale-110 transition">
                <i class="fab fa-spotify text-4xl"></i>
            </a>
            <a href="https://youtube.com" target="_blank" class="text-red-500 hover:text-red-600 hover:scale-110 transition">
                <i class="fab fa-youtube text-4xl"></i>
            </a>
            <a href="https://music.apple.com" target="_blank" class="text-pink-500 hover:text-pink-600 hover:scale-110 transition">
                <i class="fab fa-apple text-4xl"></i>
            </a>
            <a href="https://soundcloud.com" target="_blank" class="text-orange-500 hover:text-orange-600 hover:scale-110 transition">
                <i class="fab fa-soundcloud text-4xl"></i>
            </a>
        </div>
    </div>
</div>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
let duration = 25 * 60;
let timerInterval;
let isRunning = false;

function updateTimer() {
    const minutes = Math.floor(duration / 60).toString().padStart(2, '0');
    const seconds = (duration % 60).toString().padStart(2, '0');
    document.getElementById('timer').innerText = `${minutes}:${seconds}`;
    
    // Change color when running
    const timerElement = document.getElementById('timer');
    if (isRunning) {
        timerElement.classList.add('text-indigo-600');
        timerElement.classList.remove('text-gray-800');
    } else {
        timerElement.classList.add('text-gray-800');
        timerElement.classList.remove('text-indigo-600');
    }
}

function startTimer() {
    if (!timerInterval) {
        isRunning = true;
        updateTimer();
        timerInterval = setInterval(() => {
            if (duration > 0) {
                duration--;
                updateTimer();
            } else {
                clearInterval(timerInterval);
                timerInterval = null;
                isRunning = false;
                updateTimer();
                // Play sound when timer ends
                const audio = new Audio('https://assets.mixkit.co/sfx/preview/mixkit-alarm-digital-clock-beep-989.mp3');
                audio.play();
                alert('¡Tiempo completado! Toma un descanso.');
            }
        }, 1000);
    }
}

function stopTimer() {
    clearInterval(timerInterval);
    timerInterval = null;
    isRunning = false;
    updateTimer();
}

function resetTimer() {
    stopTimer();
    duration = 25 * 60;
    updateTimer();
}

updateTimer();
</script>
@endsection