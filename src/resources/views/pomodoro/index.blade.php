@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold text-center mb-4">Pomodoro</h2>

<div class="text-center">
    <div id="timer" class="text-6xl font-bold mb-4">25:00</div>
    <button onclick="startTimer()" class="bg-green-500 text-white px-4 py-2 rounded">Iniciar</button>
    <button onclick="pauseTimer()" class="bg-yellow-500 text-white px-4 py-2 rounded">Pausar</button>
    <button onclick="resetTimer()" class="bg-red-500 text-white px-4 py-2 rounded">Reiniciar</button>

    <h3 class="mt-8">Música</h3>
    <iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/37i9dQZF1DXc2aPBXGmXrt" width="300" height="80" frameBorder="0"></iframe>
</div>

<script>
let timer, timeLeft = 1500;

function updateDisplay() {
    const min = String(Math.floor(timeLeft / 60)).padStart(2, '0');
    const sec = String(timeLeft % 60).padStart(2, '0');
    document.getElementById('timer').textContent = `${min}:${sec}`;
}

function startTimer() {
    if (!timer) {
        timer = setInterval(() => {
            if (timeLeft > 0) {
                timeLeft--;
                updateDisplay();
            } else {
                clearInterval(timer);
                alert("¡Pomodoro terminado!");
            }
        }, 1000);
    }
}

function pauseTimer() {
    clearInterval(timer);
    timer = null;
}

function resetTimer() {
    pauseTimer();
    timeLeft = 1500;
    updateDisplay();
}

updateDisplay();
</script>
@endsection
