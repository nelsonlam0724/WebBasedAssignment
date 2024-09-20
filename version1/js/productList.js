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