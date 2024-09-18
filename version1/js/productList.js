document.getElementById('select-all').addEventListener('click', function() {
    let checkboxes = document.querySelectorAll('.product-checkbox');
    for (let checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
});