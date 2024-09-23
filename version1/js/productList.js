document.getElementById('select-all').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.product-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
});

function checkSelection(form) {
    const checkboxes = form.querySelectorAll('.product-checkbox');
    let anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
    
    if (!anyChecked) {
        alert('Please select at least one product to proceed.');
        return false; // Prevent form submission
    }
    return true; // Allow form submission
}

$(document).ready(function() {
    $('.product-row').hover(function(event) {
        // Get the image source
        const photoSrc = $(this).data('photo');
        const imagePreview = $('#image-preview');

        if (photoSrc) {
            // Set the image and position
            imagePreview.html('<img src="../uploads/' + photoSrc + '" alt="Product Image">');
            imagePreview.css({
                top: event.pageY + 10 + 'px', // Position the image slightly below the cursor
                left: event.pageX + 10 + 'px'
            }).show();
        }
    }, function() {
        // Hide the image preview when not hovering
        $('#image-preview').hide();
    });

    // Ensure the image follows the mouse movement
    $('.product-row').mousemove(function(event) {
        $('#image-preview').css({
            top: event.pageY + 10 + 'px',
            left: event.pageX + 10 + 'px'
        });
    });
});
