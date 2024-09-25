document.getElementById('edit-button').addEventListener('click', function() {
    var formElements = document.querySelectorAll('#category-form input, #category-form select');
    formElements.forEach(function(element) {
        element.disabled = false; // Enable form inputs for editing
    });

    // Show the "Update Category" and "Cancel" buttons, hide the "Edit" button
    document.getElementById('submit-button').style.display = 'inline'; 
    document.getElementById('edit-button').style.display = 'none';
    document.getElementById('cancel-button').style.display = 'inline';
});

document.getElementById('cancel-button').addEventListener('click', function() {
    var formElements = document.querySelectorAll('#category-form input, #category-form select');
    formElements.forEach(function(element) {
        element.disabled = true; // Disable form inputs when canceling
    });

    // Hide the "Update Category" and "Cancel" buttons, show the "Edit" button
    document.getElementById('submit-button').style.display = 'none';
    document.getElementById('edit-button').style.display = 'inline';
    document.getElementById('cancel-button').style.display = 'none';

    // Optional: reset form fields to original values
    document.getElementById('category-form').reset();
});

// Initially, disable all input fields and hide the "Update Category" button
document.querySelectorAll('#category-form input, #category-form select').forEach(function(element) {
    element.disabled = true;
});

document.getElementById('submit-button').style.display = 'none'; // Hide the submit button by default


