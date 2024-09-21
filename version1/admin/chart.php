<?php
// Example: Fetch data from a database
$data = [
    ['status' => 'Pending', 'count' => 10],
    ['status' => 'Cancelled', 'count' => 5],
    ['status' => 'Delivered', 'count' => 15],
    ['status' => 'Shipped', 'count' => 8],
    ['status' => 'Paid', 'count' => 12]
];

// Separate the data into labels and values
$statuses = [];
$counts = [];
foreach ($data as $row) {
    $statuses[] = $row['status'];
    $counts[] = $row['count'];
}

// Convert PHP arrays to JSON format for JavaScript
$status_json = json_encode($statuses);
$count_json = json_encode($counts);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart Example</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Set canvas to a fixed size */
        #pieChart{
            width: 800px !important;   /* Set width of the canvas */
            height: 600px !important;  /* Set height of the canvas */
        }
        
        
        #barChart {
            width: 300px !important;   /* Set width of the canvas */
            height: 300px !important;  /* Set height of the canvas */
        }
    </style>
</head>
<body>

    <h2>Order Status Distribution (Pie Chart)</h2>
    <canvas id="pieChart"></canvas>

    <h2>Order Status Distribution (Bar Chart)</h2>
    <canvas id="barChart"></canvas>

    <script>
        // Get PHP data into JavaScript
        const labels = <?= $status_json ?>;
        const data = <?= $count_json ?>;

        // Pie Chart configuration
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Order Status',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,  // Disable aspect ratio
                responsive: true             // Ensure it responds to screen size
            }
        });

        // Bar Chart configuration
        const barCtx = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Order Status',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                maintainAspectRatio: false,  // Disable aspect ratio
                responsive: true             // Ensure it responds to screen size
            }
        });
    </script>

</body>
</html>
