<?php
include '../_base.php';
include '../_head.php';
include '../include/sidebarAdmin.php';

$statuses = [];
$counts = [];

// Initialize variables for date filtering
$start_date = isset($_GET['start_date']) ? trim($_GET['start_date']) : '';
$end_date = isset($_GET['end_date']) ? trim($_GET['end_date']) : '';

// Start constructing the query
$query = 'SELECT status, COUNT(*) as count FROM orders WHERE 1=1';
$params = [];

if ($start_date) {
    $query .= ' AND datetime >= ?';
    $params[] = $start_date;
}

if ($end_date) {
    $query .= ' AND DATE(datetime) <= ?';
    $params[] = $end_date;
}

$query .= ' GROUP BY status';

$ord = $_db->prepare($query);
$ord->execute($params);
$orders = $ord->fetchAll();

foreach ($orders as $order) {
    $statuses[] = $order->status;
    $counts[] = $order->count;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            margin: 100px 0; 
            text-align: center;
        }
        .chart-container {
            width: 70%;
            margin: auto;
            position: relative;
            height: 400px;
        }
    </style>
</head>
<body>

    <h1>Status Chart</h1>
    <!-- Filter and Sorting Options -->
    <div class="filter-sorting">
        <form action="statusChart.php" method="get">
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" onchange="this.form.submit()" value="<?= htmlspecialchars($start_date) ?>">
            
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" onchange="this.form.submit()" value="<?= htmlspecialchars($end_date) ?>">
        </form>
    </div>

    <div class="chart-container">
        <canvas id="statusChart"></canvas>
    </div>

    <div class="chart-container">
        <canvas id="statusBarChart"></canvas>
    </div>

    <script>
        const statuses = <?php echo json_encode($statuses); ?>;
        const counts = <?php echo json_encode($counts); ?>;

        const ctx = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: statuses,
                datasets: [{
                    label: 'Order Status',
                    data: counts,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)', 
                        'rgba(255, 99, 132, 0.6)', 
                        'rgba(255, 205, 86, 0.6)', 
                        'rgba(54, 162, 235, 0.6)', 
                        'rgba(153, 102, 255, 0.6)'  
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });

        const ctxx = document.getElementById('statusBarChart').getContext('2d');
        const statusBarChart = new Chart(ctxx, {
            type: 'bar',
            data: {
                labels: statuses,
                datasets: [{
                    label: 'Order Status Count',
                    data: counts,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(255, 205, 86, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(153, 102, 255, 0.7)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1,
                    barPercentage: 0.7,
                    categoryPercentage: 0.7,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                elements: {
                    bar: {
                        borderSkipped: false,
                        borderRadius: 15,
                        hoverBorderWidth: 3
                    }
                }
            }
        });
    </script>
</body>
</html>
