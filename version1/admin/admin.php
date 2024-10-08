<?php
include '../_base.php';
include '../_head.php';
include '../include/sidebarAdmin.php';
auth('Root', 'Admin');

$currentYearMonth = date('Y-m');
$currentYear = date('Y');
$currentMonth = date('M');

// Calculate last month's sales
$firstDayLastMonth = (new DateTime('first day of last month'))->format('Y-m-d');
$lastDayLastMonth = (new DateTime('last day of last month'))->format('Y-m-d');

$salesLastMonth = $_db->prepare('SELECT SUM(total) AS total FROM orders WHERE DATE(datetime) BETWEEN ? AND ?');
$salesLastMonth->execute([$firstDayLastMonth, $lastDayLastMonth]);
$totalSalesLastMonth = $salesLastMonth->fetchColumn() ?: 0;

// Calculate current month sales
$salesCurrentMonth = $_db->prepare('SELECT total FROM orders WHERE DATE_FORMAT(datetime, "%Y-%m") = ?');
$salesCurrentMonth->execute([$currentYearMonth]);
$salesData = $salesCurrentMonth->fetchAll(PDO::FETCH_OBJ);

$totalSalesCurrentMonth = 0;
foreach ($salesData as $order) {
    $totalSalesCurrentMonth += $order->total;
}

// Calculate total year sales
$salesYear = $_db->prepare('SELECT total FROM orders WHERE DATE_FORMAT(datetime, "%Y") = ?');
$salesYear->execute([$currentYear]);
$salesDataYear = $salesYear->fetchAll(PDO::FETCH_OBJ);

$totalSalesYear = 0;
foreach ($salesDataYear as $order) {
    $totalSalesYear += $order->total;
}

// Fetch the top selling products
$topSalesData = $_db->query('
    SELECT p.name AS product_name, SUM(od.unit) AS total_units, p.price AS product_price
    FROM order_details AS od
    JOIN product AS p ON od.product_id = p.product_id
    GROUP BY od.product_id
    ORDER BY total_units DESC
    LIMIT 3
')->fetchAll(PDO::FETCH_OBJ);

$productNames = [];
$totalUnits = [];
$totalPrices = [];

foreach ($topSalesData as $data) {
    $productNames[] = $data->product_name;
    $totalUnits[] = $data->total_units;
    $totalPrices[] = $data->total_units * $data->product_price;
}

// Fetch the three most recent comments along with usernames
$recentComments = $_db->query('
    SELECT c.comment, c.datetime, c.product_id, c.user_id, u.name AS user_name
    FROM comment AS c
    JOIN user AS u ON c.user_id = u.user_id
    ORDER BY c.datetime DESC
    LIMIT 3
')->fetchAll(PDO::FETCH_OBJ);

$dates = [
    new DateTime(),
    (new DateTime())->modify('-1 day'),
    (new DateTime())->modify('-2 days')
];
$labels = [];
foreach ($dates as $date) {
    $labels[] = $date->format('Y-m-d');
}
$dataPoints = [];

foreach ($dates as $date) {
    $dateString = $date->format('Y-m-d');
    $query = 'SELECT SUM(total) AS total FROM orders WHERE DATE(datetime) = ?';
    $stmt = $_db->prepare($query);
    $stmt->execute([$dateString]);
    $total = $stmt->fetchColumn() ?: 0;

    $dataPoints[] = ['date' => $dateString, 'total' => $total];
}

$_title = 'Admin Dashboard - ' . htmlspecialchars($_user->name);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/adminWelcome.css">
    <script src="../js/currentTime.js"></script>
    <title><?= $_title ?></title>
</head>

<body>
    <div class="main-content" id="main-content">
        <h1 class="welcome">Welcome, <?= htmlspecialchars($_user->name) ?> to the Admin Dashboard</h1>
        <p class="datetime"><span id="current-datetime"></span></p>

        <div class="dashboard-grid">
            <div class="dashboard-box center-content" id="total-users-box">
                <h3>Last Month Sales</h3>
                <p id="total-sales">RM <?= number_format($totalSalesLastMonth, 2) ?></p>
            </div>

            <div class="dashboard-box center-content" id="total-month-sales-box">
                <h3>Current Month Sales (<?= $currentMonth ?>)</h3>
                <p id="total-sales">RM <?= number_format($totalSalesCurrentMonth, 2) ?></p>
            </div>

            <div class="dashboard-box center-content" id="total-sales-box">
                <h3>Total Year Sales (<?= $currentYear ?>)</h3>
                <p id="total-sales">RM <?= number_format($totalSalesYear, 2) ?></p>
            </div>

            <a href="topProductSalesChart.php">
                <div class="dashboard-box" id="top-products-box">
                    <h3>Top Products</h3>
                    <div class="chart" id="top-products-chart">
                        <canvas id="topSalesBarChart"></canvas>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            const productNames = <?php echo json_encode($productNames); ?>;
                            const totalUnits = <?php echo json_encode($totalUnits); ?>;
                            const totalPrices = <?php echo json_encode($totalPrices); ?>;
                        </script>
                        <script src="../js/topThree.js"></script>
                    </div>
                </div>
            </a>

            <a href="topSalesChart.php">
                <div class="dashboard-box" id="revenue-breakdown-box">
                    <h3>Revenue Breakdown</h3>
                    <div class="chart" id="revenue-breakdown">
                        <canvas id="barChart"></canvas>
                        <script>
                            const labels = <?= json_encode($labels); ?>;
                            const data = <?= json_encode(array_column($dataPoints, 'total')); ?>;
                        </script>
                        <script src="../js/threeDay.js"></script>
                    </div>
                </div>
            </a>

            <a href="commentList.php">
                <div class="dashboard-box" id="recent-comment-box">
                    <h3>Recent Comments</h3>
                    <?php if ($recentComments): ?>
                        <ul>
                            <?php foreach ($recentComments as $comment): ?>
                                <li>
                                    <strong><?= htmlspecialchars($comment->user_name) ?>(<?= htmlspecialchars($comment->user_id) ?>):</strong>
                                    <br><?= htmlspecialchars($comment->comment) ?>
                                    <br><small>Date: <?= htmlspecialchars($comment->datetime) ?></small>
                                    <br><small>Product: <strong><?= htmlspecialchars($comment->product_id) ?></strong></small>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>No comments available.</p>
                    <?php endif; ?>
                </div>
            </a>

        </div>
    </div>
</body>

</html>
