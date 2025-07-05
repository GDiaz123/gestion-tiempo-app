@extends('layouts.app')

@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Calendario</h2>
<div id='calendar'></div>
@endsection

@section('scripts')
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/main.min.js'></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        events: @json($events),
    });
    calendar.render();
});
</script>
@endsection
