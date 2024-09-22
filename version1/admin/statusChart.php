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
    </script>
    <script src="../js/status.js"></script>
</body>
</html>
