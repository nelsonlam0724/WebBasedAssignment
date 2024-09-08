function selectAll() {
    var checkboxes = document.querySelectorAll('input[name="tables[]"]');
    var allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
    checkboxes.forEach(checkbox => checkbox.checked = !allChecked);
}

function downloadAndRedirect(fileName) {
    var downloadFrame = document.createElement('iframe');
    downloadFrame.style.display = 'none';
    downloadFrame.src = 'downloadBackup.php?file=' + encodeURIComponent(fileName);
    document.body.appendChild(downloadFrame);

    // Redirect after download
    setTimeout(function() {
        window.location.href = 'admin.php';
    }, 500); // Wait a second to ensure download starts
}