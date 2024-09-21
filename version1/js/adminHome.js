const sidebar = document.getElementById('sidebar');
const toggleBtn = document.getElementById('toggle-btn');

// Toggle sidebar visibility when clicking the burger icon
toggleBtn.addEventListener('click', function () {
    sidebar.classList.toggle('show'); // Show or hide the sidebar
    updateToggleButton(); // Update button visibility
});

// Hide sidebar when clicking outside of it
document.addEventListener('click', function (event) {
    const isClickInsideSidebar = sidebar.contains(event.target);
    const isClickOnToggleBtn = toggleBtn.contains(event.target);

    // If the sidebar is open and the click is outside of the sidebar or the toggle button
    if (sidebar.classList.contains('show') && !isClickInsideSidebar && !isClickOnToggleBtn) {
        sidebar.classList.remove('show'); // Hide the sidebar
        setTimeout(updateToggleButton, 400); // Delay the button update to match the transition duration
    }
});

// Function to handle the visibility of the toggle button
function updateToggleButton() {
    if (sidebar.classList.contains('show')) {
        toggleBtn.style.display = 'none'; // Hide toggle button when sidebar is shown
    } else {
        toggleBtn.style.display = 'block'; // Show toggle button when sidebar is hidden
    }
}
