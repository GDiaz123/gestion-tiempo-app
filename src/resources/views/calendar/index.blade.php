@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4 max-w-6xl">
        <!-- Encabezado con navegación -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                {{ $currentDate->locale('es')->isoFormat('MMMM YYYY') }}
            </h1>
            <div class="flex space-x-2">
                <button onclick="navigateMonth(-1)"
                    class="px-4 py-2 bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 transition">
                    <i class="fas fa-chevron-left mr-1"></i> Anterior
                </button>
                <button onclick="navigateMonth(0)"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    <i class="fas fa-calendar-day mr-1"></i> Hoy
                </button>
                <button onclick="navigateMonth(1)"
                    class="px-4 py-2 bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 transition">
                    Siguiente <i class="fas fa-chevron-right ml-1"></i>
                </button>
            </div>
        </div>

        <!-- Nombres de días -->
        <div class="grid grid-cols-7 gap-1 mb-2 text-center font-medium text-gray-600 bg-gray-100 rounded-t-lg py-2">
            @foreach(['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'] as $day)
                <div>{{ $day }}</div>
            @endforeach
        </div>

        <!-- Grid del calendario -->
        <div class="grid grid-cols-7 gap-1 bg-white rounded-b-lg shadow-sm min-h-calendar">
            <!-- Días vacíos al inicio -->
            @for ($i = 1; $i < $startDayOfWeek; $i++)
                <div class="h-32 p-1 bg-gray-50 rounded"></div>
            @endfor

            <!-- Días del mes -->
            @for ($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $date = $currentDate->copy()->startOfMonth()->addDays($day - 1);
                    $dateString = $date->toDateString();
                    $isToday = now()->toDateString() == $dateString;
                    $dayEvents = $eventos->where('date', $dateString);
                @endphp
                <div class="h-32 p-1 border border-gray-200 rounded hover:bg-indigo-50 transition cursor-pointer relative
                              {{ $isToday ? 'border-2 border-indigo-500 bg-indigo-50' : '' }}
                              {{ $date->isWeekend() ? 'bg-gray-50' : '' }}" onclick="openModal('{{ $dateString }}')">

                    <!-- Número del día -->
                    <div class="text-right mb-1">
                        <span class="inline-block w-7 h-7 rounded-full text-center leading-7 
                                        {{ $isToday ? 'bg-indigo-600 text-white font-bold' : 'text-gray-700' }}">
                            {{ $day }}
                        </span>
                    </div>

                    <!-- Eventos -->
                    <div class="space-y-1 overflow-y-auto max-h-20">
                        @foreach($dayEvents as $evento)
                            <div
                                class="text-xs p-1 rounded truncate flex items-start
                                                {{ $evento->type == 'important' ? 'bg-red-100 text-red-800 border-l-4 border-red-500' : 'bg-blue-100 text-blue-800 border-l-4 border-blue-500' }}">
                                <span class="font-medium flex-1 truncate">{{ $evento->title }}</span>
                                @if($evento->start_datetime)
                                    <span class="text-xxs ml-1 whitespace-nowrap">
                                        {{ Carbon\Carbon::parse($evento->start_datetime)->format('H:i') }}
                                        @if($evento->end_datetime)
                                            - {{ Carbon\Carbon::parse($evento->end_datetime)->format('H:i') }}
                                        @endif
                                    </span>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Botón para añadir evento -->
                    <button
                        class="absolute bottom-1 right-1 w-6 h-6 bg-indigo-500 text-white rounded-full opacity-0 hover:opacity-100 transition-opacity flex items-center justify-center"
                        onclick="event.stopPropagation(); addEvent('{{ $dateString }}')">
                        <i class="fas fa-plus text-xs"></i>
                    </button>
                </div>
            @endfor
        </div>
    </div>

    <!-- Modal para eventos -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl w-96">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800" id="modalDateTitle">Agregar Evento</h2>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form method="POST" action="{{ route('calendar.store') }}">
                @csrf
                <input type="hidden" name="date" id="eventDate">

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Título *</label>
                    <input type="text" name="title"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        required>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Hora inicio *</label>
                        <input type="time" name="start_time"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Hora fin</label>
                        <input type="time" name="end_time"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="important" value="1"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-700">Evento importante</span>
                    </label>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                        Guardar Evento
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <style>
            .max-h-20 {
                max-height: 5rem;
            }

            .text-xxs {
                font-size: 0.65rem;
            }

            .min-h-calendar {
                min-height: 24rem;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Navegación entre meses
            function navigateMonth(offset) {
                const currentMonth = "{{ $currentMonth }}";
                let [year, month] = currentMonth.split('-').map(Number);

                if (offset === 0) {
                    window.location.href = "{{ route('calendar.index') }}";
                    return;
                }

                month += offset;

                if (month > 12) {
                    month = 1;
                    year++;
                } else if (month < 1) {
                    month = 12;
                    year--;
                }

                const newMonth = `${year}-${String(month).padStart(2, '0')}`;
                window.location.href = `{{ route('calendar.index') }}?month=${newMonth}`;
            }

            // Funciones del modal
            function openModal(date) {
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                const dateStr = new Date(date).toLocaleDateString('es-ES', options);

                document.getElementById('eventDate').value = date;
                document.getElementById('modalDateTitle').textContent =
                    `Evento para ${dateStr.charAt(0).toUpperCase() + dateStr.slice(1)}`;
                document.getElementById('modal').classList.remove('hidden');
            }

            function closeModal() {
                document.getElementById('modal').classList.add('hidden');
            }

            function addEvent(date) {
                document.getElementById('eventDate').value = date;
                document.querySelector('input[name="title"]').focus();
                openModal(date);
            }

            // Cerrar modal al hacer clic fuera
            document.addEventListener('click', function (event) {
                if (event.target === document.getElementById('modal')) {
                    closeModal();
                }
            });

            // Prevenir que el clic en el formulario cierre el modal
            document.getElementById('modal').querySelector('form').addEventListener('click', function (event) {
                event.stopPropagation();
            });
        </script>
    @endpush
@endsection