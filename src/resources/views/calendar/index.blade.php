@extends('layouts.app')

@section('content')
<div>
    <h1 class="text-2xl font-bold mb-4">Calendario</h1>

    <div class="grid grid-cols-7 gap-2 text-center">
        @php
            $daysInMonth = now()->daysInMonth;
            $startDay = now()->startOfMonth()->dayOfWeekIso;
        @endphp

        @for ($i = 1; $i < $startDay; $i++)
            <div></div>
        @endfor

        @for ($day = 1; $day <= $daysInMonth; $day++)
            @php
                $date = now()->startOfMonth()->addDays($day-1)->toDateString();
                $today = now()->toDateString() == $date;
            @endphp
            <div 
                class="border p-2 cursor-pointer hover:bg-indigo-100 {{ $today ? 'bg-indigo-300 text-white' : '' }}" 
                onclick="openModal('{{ $date }}')">
                {{ $day }}
                @foreach($eventos as $evento)
                    @if($evento->date == $date)
                        <div class="text-xs mt-1 bg-green-100 rounded px-1">{{ $evento->title }}</div>
                    @endif
                @endforeach
            </div>
        @endfor
    </div>
</div>

@include('calendar._modal')
@endsection

@push('scripts')
<script>
function openModal(date) {
    document.getElementById('eventDate').value = date;
    document.getElementById('modal').classList.remove('hidden');
}
function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}
</script>
@endpush
