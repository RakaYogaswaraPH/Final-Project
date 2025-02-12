// Toastr js file for showing notifications
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-full-width",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

document.addEventListener('DOMContentLoaded', function () {
    const chk = document.getElementById('chk');

    // Fungsi untuk menangani form yang aktif
    function handleFormState() {
        const selectedForm = localStorage.getItem('selectedForm');

        if (selectedForm === 'signup') {
            chk.checked = true;
        } else if (selectedForm === 'login') {
            chk.checked = false;
        }

        // Hapus data dari localStorage setelah digunakan
        localStorage.removeItem('selectedForm');
    }

    // Jalankan handler saat halaman dimuat
    handleFormState();

    // Tambahkan event listener untuk menghandle perubahan manual pada checkbox
    chk.addEventListener('change', function () {
        // Update URL tanpa me-refresh halaman
        const newHash = this.checked ? '#signup' : '#login';
        history.pushState(null, '', newHash);
    });
});