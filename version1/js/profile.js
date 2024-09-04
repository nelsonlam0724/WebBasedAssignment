function toggleEditForm() {
    var form = document.getElementById("editForm");
    if (form.style.display === "none") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}

$(document).ready(function() {
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
});

