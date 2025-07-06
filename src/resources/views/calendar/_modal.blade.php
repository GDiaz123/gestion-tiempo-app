<div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow w-96">
        <h2 class="text-lg font-bold mb-4">Agregar Evento</h2>
        <form method="POST" action="{{ route('calendar.store') }}">
            @csrf
            <input type="hidden" name="date" id="eventDate">
            <div class="mb-2">
                <label>Título</label>
                <input type="text" name="title" class="w-full border rounded px-2 py-1" required>
            </div>
            <div class="mb-2">
                <label>Hora inicio</label>
                <input type="time" name="start_time" class="w-full border rounded px-2 py-1" required>
            </div>
            <div class="mb-2">
                <label>Hora fin</label>
                <input type="time" name="end_time" class="w-full border rounded px-2 py-1" required>
            </div>
            <div class="flex justify-end mt-4 space-x-2">
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Guardar</button>
            </div>
        </form>
    </div>
</div>
