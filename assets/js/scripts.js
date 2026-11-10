// Skrip halaman pelanggan
document.addEventListener('DOMContentLoaded', function () {
    // Aktifkan tooltip Bootstrap bila ada elemen dengan atribut data-bs-toggle="tooltip"
    if (typeof bootstrap === 'undefined') {
        return;
    }
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function (el) {
        new bootstrap.Tooltip(el);
    });
});