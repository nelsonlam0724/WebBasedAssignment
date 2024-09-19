function toggleEditForm() {
    var form = document.getElementById("editForm");
    if (form.style.display === "none") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}

function toggleEditForm(field, event) {
    event.stopPropagation(); // Prevent click event from bubbling up
    const form = document.getElementById(`edit_${field}_form`);
    form.style.display = form.style.display === 'block' ? 'none' : 'block';

    // Position the form near the icon
    const icon = event.target;
    const rect = icon.getBoundingClientRect();
    form.style.top = `${rect.bottom + window.scrollY}px`;
    form.style.left = `${rect.left + window.scrollX}px`;
}

function hideEditForm(field) {
    document.getElementById(`edit_${field}_form`).style.display = 'none';
}

// Click outside the form to hide it
document.addEventListener('click', function (event) {
    const editForms = document.querySelectorAll('.edit-form');
    editForms.forEach(form => {
        if (!form.contains(event.target) && !form.previousElementSibling.contains(event.target)) {
            form.style.display = 'none';
        }
    });
});


$(document).ready(function () {
    $('label.upload input[type=file]').on('change', e => {
        const f = e.target.files[0];
        const img = $(e.target).siblings('img')[0];

        if (!img) return;

        img.dataset.src ??= img.src;

        if (f?.type.startsWith('image/')) {
            img.src = URL.createObjectURL(f);
        } else {
            img.src = img.dataset.src;
            e.target.value = '';
        }
    });
    photo_value

});


document.addEventListener('DOMContentLoaded', function () {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('birthday').setAttribute('max', today);
});


