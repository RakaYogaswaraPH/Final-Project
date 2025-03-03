function showProgramDetails(program) {
    const modal = document.getElementById("programModal");
    const detailsContainer = document.getElementById("programDetails");

    // Format list content by splitting on newlines
    const formatListContent = (content) => {
        return content
            .split("\n")
            .map(
                (item) =>
                    `<p style="margin-bottom: 8px; padding-left: 15px; position: relative;">
<span style="position: absolute; left: 0;">•</span> ${item.trim()}
</p>`
            )
            .join("");
    };

    detailsContainer.innerHTML = `
<div class="modal-section">
<h2>${program.title}</h2>
</div>

<div class="modal-section">
<h3>Deskripsi</h3>
<p>${program.description}</p>
</div>

<div class="modal-section">
<h3>Banner</h3>
<img src="banner/${program.image
        }" alt="Program Banner" style="max-width: 100%; height: auto;">
</div>

<div class="modal-section">
<h3>Harga</h3>
<div class="price-tag">
Rp ${program.price.toLocaleString("id-ID")}
</div>

</div>
<div class="modal-section">
<h3>Tujuan Umum</h3>
<div class="list-content">
<p>${program.General_Objectives}</p>
</div>

</div>
<div class="modal-section">
<h3>Tujuan Khusus</h3>
<div class="list-content">
${formatListContent(program.Specific_Objectives)}
</div>

</div>
<div class="modal-section">
<h3>Kelompok Sasaran</h3>
<div class="list-content">
${formatListContent(program.Target_Group)}
</div>

</div>
<div class="modal-section">
<h3>Aspek Kompetensi</h3>
<div class="list-content">
${formatListContent(program.Competency_Aspects)}
</div>

</div>
`;

    modal.style.display = "block";
    modal.offsetHeight;
    modal.classList.add("show");
}

function closeModal() {
    const modal = document.getElementById("programModal");
    modal.classList.remove("show");
    setTimeout(() => {
        modal.style.display = "none";
    }, 300);
}

document.querySelector(".close-modal").onclick = closeModal;

window.onclick = function (event) {
    const modal = document.getElementById("programModal");
    if (event.target == modal) {
        closeModal();
    }
};

document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
        closeModal();
    }
});
