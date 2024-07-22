// Login Modal
function openModal(modalId) {
    const dropdownChart = document.getElementById('dropdownChart'); 
    if (dropdownChart) {
        dropdownChart.classList.replace('absolute', 'hidden');
    }
    document.getElementById(modalId).classList.remove('hidden');
}
function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}
function openAndCloseModal(registerModalId, loginModalId) {
    closeModal(loginModalId);
    openModal(registerModalId);
}