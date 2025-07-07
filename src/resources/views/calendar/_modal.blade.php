<!-- Modal para eventos (versión corregida) -->
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

            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeModal()"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                    Cancelar
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        // Función para abrir el modal
        function openModal(date) {
            // Formatear la fecha en español para mostrarla en el título
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const dateStr = new Date(date).toLocaleDateString('es-ES', options);

            // Actualizar elementos del modal
            document.getElementById('eventDate').value = date;
            document.getElementById('modalDateTitle').textContent =
                `Evento para ${dateStr.charAt(0).toUpperCase() + dateStr.slice(1)}`;

            // Mostrar el modal
            document.getElementById('modal').classList.remove('hidden');
        }

        // Función para cerrar el modal
        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }

        // Función para añadir evento (desde el botón +)
        function addEvent(date) {
            document.getElementById('eventDate').value = date;
            document.getElementById('modal').classList.remove('hidden');
            document.querySelector('input[name="title"]').focus();
        }

        // Cerrar modal al hacer clic fuera
        document.addEventListener('click', function (event) {
            const modal = document.getElementById('modal');
            if (event.target === modal) {
                closeModal();
            }
        });

        // Prevenir que el clic en el formulario cierre el modal
        document.getElementById('modal').querySelector('form').addEventListener('click', function (event) {
            event.stopPropagation();
        });
    </script>
@endpush