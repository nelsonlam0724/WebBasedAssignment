<?php
include '../_base.php';
include '../_head.php';
require_once '../lib/SimplePager.php';
include '../include/sidebarAdmin.php';

auth('Root', 'Admin');

$start_date = isset($_GET['start_date']) ? trim($_GET['start_date']) : '';
$end_date = isset($_GET['end_date']) ? trim($_GET['end_date']) : '';

$period = 'year';

if ($start_date && $end_date) {
    $start = new DateTime($start_date);
    $end = new DateTime($end_date);
    $dateDiff = $start->diff($end);
    $totalDays = $dateDiff->days;
    $totalMonths = $dateDiff->m + ($dateDiff->y * 12);

    if ($totalDays === 0) {
        $period = 'week';
    } elseif ($totalDays <= 7) {
        $period = 'day';
    } elseif ($totalMonths >= 2) {
        $period = 'month';
    } else {
        $period = 'week';
    }
} else if ($start_date || $end_date) {
    if ($start_date) {
        $start = new DateTime($start_date);
        $end = new DateTime();
        $totalDays = $start->diff($end)->days;

        if ($totalDays === 0) {
            $period = 'week';
        } elseif ($totalDays <= 7) {
            $period = 'day';
        } else {
            $period = 'week';
        }
    } else if ($end_date) {
        $end = new DateTime($end_date);
        $start = (new DateTime())->modify('-1 month'); 
        $totalDays = $end->diff($start)->days;

        if ($totalDays <= 7) {
            $period = 'day'; 
        } else {
            $period = 'week';
        }
    }
} else {
    $period = 'year'; 
}


$dataPoints = [];
$labels = [];

if ($period === 'day') {
    for ($i = 0; $i <= $totalDays; $i++) {
        $currentDate = clone $start;
        $currentDate->modify("+$i days");
        $currentDateString = $currentDate->format('Y-m-d');

        $query = 'SELECT SUM(total) as total FROM orders WHERE DATE(datetime) = ?';
        $stmt = $_db->prepare($query);
        $stmt->execute([$currentDateString]);
        $total = $stmt->fetchColumn() ?: 0;

        $dataPoints[] = ['date' => $currentDateString, 'total' => $total];
        $labels[] = $currentDateString;
    }
} elseif ($period === 'week') {
    $currentMonthStart = (new DateTime($start->format('Y-m-01')));
    $currentMonthEnd = (new DateTime($start->format('Y-m-t')));

    $currentWeek = 1;
    while ($currentMonthStart <= $currentMonthEnd) {
        $weekStart = clone $currentMonthStart;
        $weekEnd = clone $currentMonthStart->modify('+6 days');

        if ($weekEnd > $currentMonthEnd) {
            $weekEnd = $currentMonthEnd;
        }

        $query = 'SELECT SUM(total) as total FROM orders WHERE DATE(datetime) BETWEEN ? AND ?';
        $stmt = $_db->prepare($query);
        $stmt->execute([$weekStart->format('Y-m-d'), $weekEnd->format('Y-m-d')]);
        $total = $stmt->fetchColumn() ?: 0;

        $dataPoints[] = ['week' => $currentWeek, 'total' => $total];
        $labels[] = "wk$currentWeek";

        $currentWeek++;
        $currentMonthStart->modify('+1 day');
    }
} elseif ($period === 'month') {
    $currentStart = clone $start;
    while ($currentStart <= $end) {
        $month = $currentStart->format('Y-m');

        $query = 'SELECT SUM(total) as total FROM orders WHERE DATE_FORMAT(datetime, "%Y-%m") = ?';
        $stmt = $_db->prepare($query);
        $stmt->execute([$month]);
        $total = $stmt->fetchColumn() ?: 0;

        $dataPoints[] = ['month' => $month, 'total' => $total];
        $labels[] = $month;

        $currentStart->modify('first day of next month');
    }
} elseif ($period === 'year') {
    $currentYear = (int)date('Y');
    for ($year = $currentYear - 5; $year <= $currentYear; $year++) {
        $query = 'SELECT SUM(total) as total FROM orders WHERE YEAR(datetime) = ?';
        $stmt = $_db->prepare($query);
        $stmt->execute([$year]);
        $total = $stmt->fetchColumn() ?: 0;

        $dataPoints[] = ['year' => $year, 'total' => $total];
        $labels[] = $year;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/orders.js"></script>
    <link rel="stylesheet" href="../css/orderList.css"> <!-- Link the external CSS -->
    <title>Summary Report</title>
</head>

<body>
    <div class="container">
        <h1>Summary Report</h1>

        <!-- Filter and Sorting Options -->
        <div class="filter-sorting">
            <form action="topSalesChart.php" method="get">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" id="start_date" onchange="this.form.submit()" value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : '' ?>">

                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" id="end_date" onchange="this.form.submit()" value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : '' ?>">
            </form>
        </div>

        <div class="container">
            <h1>Sales Chart</h1>

            <h2>Bar Chart</h2>
            <canvas id="barChart"></canvas>

            <h2>Pie Chart</h2>
            <canvas id="pieChart"></canvas>
        </div>

        <br>
        <script>
            const labels = <?= json_encode($labels); ?>;
            const data = <?= json_encode(array_column($dataPoints, 'total')); ?>;
        </script>
        <script src="../js/topSalesChart.js"></script>

        <div class="action-buttons">
            <a href="admin.php" class="action-button"><button>Back To Menu</button></a>
            <a href="generateReport.php"><button>Summary Report</button></a>
            <a href="statusChart.php" class="action-button"><button>Status Chart</button></a>
            <a href="topProductSalesChart.php" class="action-button"><button>Top Product Sales Chart</button></a>
        </div>
    </div>
</body>

</html>