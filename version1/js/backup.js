function downloadAndRedirect(fileName) {
    // Create and append the iframe to trigger download
    var downloadFrame = document.createElement('iframe');
    downloadFrame.style.display = 'none';
    downloadFrame.src = 'downloadBackup.php?file=' + encodeURIComponent(fileName);
    document.body.appendChild(downloadFrame);

    // Clear cookie
    clearSelectedTablesCookie();

    // Redirect after a short delay to ensure the cookie is cleared
    setTimeout(function () {
        window.location.href = 'admin.php';
    }, 500);
}


document.addEventListener('DOMContentLoaded', function () {
    // Retrieve and update the selected tables from cookies
    const selectedTablesCookie = document.cookie.replace(/(?:(?:^|.*;\s*)selectedTables\s*\=\s*([^;]*).*$)|^.*$/, "$1");
    const selectedTables = new Set(selectedTablesCookie ? JSON.parse(decodeURIComponent(selectedTablesCookie)) : []);
    const checkboxes = document.querySelectorAll('input[name="tables[]"]');

    // Update checkboxes based on selected tables
    checkboxes.forEach(checkbox => {
        if (selectedTables.has(checkbox.value)) {
            checkbox.checked = true;
        }
    });

    // Handle select all button click
    document.querySelector('.select-all-button').addEventListener('click', function () {
        // Fetch all table names from the server and update the selection
        fetchAllTableNames().then(allTables => {
            allTables.forEach(tableName => {
                selectedTables.add(tableName);
            });
            document.cookie = "selectedTables=" + encodeURIComponent(JSON.stringify(Array.from(selectedTables))) + "; path=/";

            // Update checkboxes on the current page
            checkboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
        });
    });

    // Handle individual checkbox click
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            if (checkbox.checked) {
                selectedTables.add(checkbox.value);
            } else {
                selectedTables.delete(checkbox.value);
            }
            document.cookie = "selectedTables=" + encodeURIComponent(JSON.stringify(Array.from(selectedTables))) + "; path=/";
        });
    });
});

// Function to fetch all table names from the server
function fetchAllTableNames() {
    return fetch('getAllTable.php') // Adjust URL to your actual endpoint
        .then(response => response.json())
        .then(data => data.tables); // Assume the response is JSON with a 'tables' array
}

// Function to clear the selectedTables cookie
function clearSelectedTablesCookie() {
    document.cookie = "selectedTables=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
}

// Function to clear the selectedTables cookie
function clearSelectedTablesCookie() {
    document.cookie = "selectedTables=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
}