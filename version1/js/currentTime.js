// Function to update the date, time, and day of the week
function updateDateTime() {
    const now = new Date();

    // Format the date (YYYY-MM-DD)
    const year = now.getFullYear();
    const month = (now.getMonth() + 1).toString().padStart(2, '0'); // Months are 0-based
    const day = now.getDate().toString().padStart(2, '0');

    // Get the day of the week
    const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const dayOfWeek = daysOfWeek[now.getDay()]; // Returns a number (0-6)

    // Format the time (HH:MM:SS)
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const seconds = now.getSeconds().toString().padStart(2, '0');

    const dateString = `${year}-${month}-${day}`;
    const timeString = `${hours}:${minutes}:${seconds}`;

    // Combine day, date, and time
    const dateTimeString = `${dayOfWeek}, ${dateString} ${timeString}`;

    // Update the span content with the current day, date, and time
    document.getElementById('current-datetime').textContent = dateTimeString;
}

// Update the date and time every second
setInterval(updateDateTime);

// Set the initial date and time when the page loads
updateDateTime();
