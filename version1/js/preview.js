document.addEventListener('DOMContentLoaded', function() {
    const photoInput = document.getElementById('photo[]');
    const previewContainer = document.getElementById('image-previews');
    const defaultPhoto = document.getElementById('default-photo');

    photoInput.addEventListener('change', function(event) {
        const files = event.target.files;

        // Reset preview container
        previewContainer.innerHTML = ''; 

        if (files.length > 0) {
            defaultPhoto.style.display = 'none'; // Hide default photo
        } else {
            defaultPhoto.style.display = 'block'; // Show default photo if no images selected
        }

        const limit = 3; // Maximum number of images allowed
        const validFiles = Array.from(files).slice(0, limit); // Limit to 3 files

        validFiles.forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'Image Preview';
                    img.classList.add('preview-image'); // You can style these images via CSS
                    previewContainer.appendChild(img);
                };

                reader.readAsDataURL(file); // Read the file as a data URL to display
            }
        });

        if (files.length > limit) {
            alert('You can only upload up to 3 images.');
        }
    });
});
