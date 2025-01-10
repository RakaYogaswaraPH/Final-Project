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

// User Control
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

// Modal 
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById("editModal");
    const closeBtn = document.querySelector('.close');

    // Fungsi untuk menutup modal
    function closeModal() {
        modal.classList.remove('show');
        setTimeout(() => {
            modal.style.display = "none";
        }, 300);
        document.body.classList.remove('modal-open');
    }

    // Event listener untuk tombol close
    if (closeBtn) {
        closeBtn.onclick = closeModal;
    }

    // Event listener untuk klik di luar modal
    window.onclick = function (event) {
        if (event.target == modal) {
            closeModal();
        }
    };

    // Event listener untuk tombol Escape
    document.addEventListener('keydown', function (event) {
        if (event.key === "Escape" && modal.classList.contains('show')) {
            closeModal();
        }
    });
});

// Fungsi untuk membuka modal dengan animasi
function openEditModal(testimonial) {
    const modal = document.getElementById("editModal");
    modal.style.display = "block";
    setTimeout(() => {
        modal.classList.add('show');
    }, 10);
    document.body.classList.add('modal-open');

    document.getElementById("edit_id").value = testimonial.id;
    document.getElementById("current_image").src = "profile/" + testimonial.image;
    document.getElementById("edit_name").value = testimonial.name;
    document.getElementById("edit_course_name").value = testimonial.course_name;
    document.getElementById("edit_review").value = testimonial.review;
    document.getElementById("edit_program_name").value = testimonial.program_name;
    document.getElementById("edit_linkedin").value = testimonial.linkedin;
}

function openEditModalPortofolio(portofolio) {
    const modal = document.getElementById("editModal");
    modal.style.display = "block";
    setTimeout(() => {
        modal.classList.add('show');
    }, 10);
    document.body.classList.add('modal-open');

    // Sesuaikan dengan nama field yang benar
    document.getElementById("edit_id").value = portofolio.id;
    document.getElementById("current_image").src = "portofolio/" + portofolio.image;
    document.getElementById("project_name").value = portofolio.project_name;
    document.getElementById("username").value = portofolio.username;
    document.getElementById("program_name").value = portofolio.program_name;
    document.getElementById("project_link").value = portofolio.project_link;
}

// Tambahkan event click pada gambar di tabel
document.querySelectorAll('.unfixed-table img').forEach(img => {
    img.style.cursor = 'pointer';
    img.addEventListener('click', function() {
        openImageModal(this.src);
    });
});

function openImageModal(imageSrc) {
    const modal = document.getElementById('imagePreviewModal');
    const modalImg = document.getElementById('modalImage');
    const modalContent = modal.querySelector('.modal-image-content');
    
    modalImg.src = imageSrc;
    modal.style.display = 'block';
    
    // Trigger reflow
    modal.offsetHeight;
    
    // Add show classes for animation
    modal.classList.add('show');
    modalContent.classList.add('show');
}

// Close modal when clicking on X or outside the image
document.querySelector('.close-image-modal').addEventListener('click', closeImageModal);
document.getElementById('imagePreviewModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImageModal();
    }
});

function closeImageModal() {
    const modal = document.getElementById('imagePreviewModal');
    const modalContent = modal.querySelector('.modal-image-content');
    
    modal.classList.remove('show');
    modalContent.classList.remove('show');
    
    // Wait for animation to complete before hiding
    setTimeout(() => {
        modal.style.display = 'none';
    }, 300);
}

// Close modal with ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});