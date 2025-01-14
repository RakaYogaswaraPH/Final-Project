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

function confirmDelete(event, button, deleteType) {
    event.preventDefault();
    const form = button.closest('form');
    const id = form.querySelector('input[name="id"]').value;

    // Buat tombol konfirmasi
    const confirmButton = `<button onclick="executeDelete(${id}, '${deleteType}')" 
    style="background: #d9534f; color: white; border: none; padding: 5px 10px; margin-right: 5px; border-radius: 3px;">Ya</button>`;
    const cancelButton = `<button onclick="toastr.clear()" 
    style="background: #5bc0de; color: white; border: none; padding: 5px 10px; border-radius: 3px;">Tidak</button>`;

    // Tampilkan toastr dengan tombol konfirmasi
    toastr.info(
        `${confirmButton}${cancelButton}`,
        'Apakah Anda yakin ingin menghapus data ini?'
    );
}

function executeDelete(id, deleteType) {
    // Buat form untuk submit
    const form = document.createElement('form');
    form.method = 'POST';
    form.style.display = 'none';

    const idInput = document.createElement('input');
    idInput.type = 'hidden';
    idInput.name = 'id';
    idInput.value = id;

    const deleteInput = document.createElement('input');
    deleteInput.type = 'hidden';
    deleteInput.name = deleteType;
    deleteInput.value = '1';

    form.appendChild(idInput);
    form.appendChild(deleteInput);
    document.body.appendChild(form);

    // Submit form
    form.submit();
}

document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has('success')) {
        const action = urlParams.get('action');
        if (action === 'approve') {
            toastr.success('Pengajuan telah berhasil disetujui!', 'Sukses');
        } else if (action === 'reject') {
            toastr.warning('Pengajuan telah ditolak!', 'Perhatian');
        }
    }

    if (urlParams.has('error')) {
        toastr.error('Terjadi kesalahan saat memproses pengajuan.', 'Error');
    }

    if (urlParams.has('deleted')) {
        toastr.info('Pengajuan telah berhasil dihapus.', 'Informasi');
    }
});
