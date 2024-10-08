document.getElementById('edit-button').addEventListener('click', function() {
    var formElements = document.querySelectorAll('#product-form input, #product-form select, #product-form textarea');
    formElements.forEach(function(element) {
        element.disabled = false; // Enable form inputs for editing
    });

    // Show the "Update Product" and "Cancel" buttons, hide the "Edit" button
    document.getElementById('submit-button').style.display = 'inline'; 
    document.getElementById('edit-button').style.display = 'none';
    document.getElementById('cancel-button').style.display = 'inline';
});

document.getElementById('cancel-button').addEventListener('click', function() {
    var formElements = document.querySelectorAll('#product-form input, #product-form select, #product-form textarea');
    formElements.forEach(function(element) {
        element.disabled = true; // Disable form inputs when canceling
    });

    // Hide the "Update Product" and "Cancel" buttons, show the "Edit" button
    document.getElementById('submit-button').style.display = 'none';
    document.getElementById('edit-button').style.display = 'inline';
    document.getElementById('cancel-button').style.display = 'none';

    // Hide the "Edit Category" button when canceling
    document.getElementById('edit-category-btn').style.display = 'none';

    // Optional: reset form fields to original values
    document.getElementById('product-form').reset();
    document.getElementById('product-photo').src = '../uploads/<?= htmlspecialchars($product->product_photo) ?>';
});

// Initially, disable all input fields and hide the "Update Product" button
document.querySelectorAll('#product-form input, #product-form select, #product-form textarea').forEach(function(element) {
    element.disabled = true;
});

document.getElementById('submit-button').style.display = 'none'; // Hide the submit button by default


