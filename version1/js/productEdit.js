document.getElementById('edit-button').addEventListener('click', function() {
    var formElements = document.querySelectorAll('#product-form input, #product-form select, #product-form textarea');
    formElements.forEach(function(element) {
        element.disabled = false; // Enable form inputs for editing
    });

    // Show the "Update Product" and "Cancel" buttons, hide the "Edit" button
    document.getElementById('submit-button').style.display = 'inline'; 
    document.getElementById('edit-button').style.display = 'none';
    document.getElementById('cancel-button').style.display = 'inline';

    // Show the "Edit Category" button
    document.getElementById('edit-category-btn').style.display = 'inline';
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

document.getElementById('edit-category-btn').addEventListener('click', function () {
    var categoryInput = document.getElementById('edit-category-input');
    categoryInput.style.display = (categoryInput.style.display === 'none') ? 'block' : 'none';
});

document.addEventListener('DOMContentLoaded', function () {
    const editCategoryBtn = document.getElementById('edit-category-btn');
    const categorySelect = document.getElementById('category-select');
    const categoryInput = document.getElementById('new-category-name');

    editCategoryBtn.addEventListener('click', function () {
        // Hide the category select dropdown and show the input text field
        if (categorySelect.style.display === 'none') {
            categorySelect.style.display = 'inline-block';
            categoryInput.style.display = 'none';
            editCategoryBtn.textContent = 'Edit Category';
        } else {
            categorySelect.style.display = 'none';
            categoryInput.style.display = 'inline-block';
            editCategoryBtn.textContent = 'Cancel Edit';
        }
    });
});

document.getElementById('submit-button').style.display = 'none'; // Hide the submit button by default
