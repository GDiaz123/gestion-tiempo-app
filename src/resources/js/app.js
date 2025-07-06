import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

function openModal(date) {
    document.getElementById('eventDate').value = date;
    document.getElementById('modal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}

window.openModal = openModal;
window.closeModal = closeModal;

