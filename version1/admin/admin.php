<?php
include '../_base.php';
include '../_head.php';
include '../include/sidebarAdmin.php'; 
auth('Root', 'Admin');

$member = $_db->query('SELECT * FROM user WHERE role = "Member"')->fetchAll();

$currentYearMonth = date('Y-m');
$currentYear = date('Y');
$currentMonth = date('M');

$sales = $_db->prepare('SELECT total FROM orders WHERE DATE_FORMAT(datetime, "%Y-%m") = ?');
$sales->execute([$currentYearMonth]);
$salesData = $sales->fetchAll(PDO::FETCH_OBJ);

$salesYear = $_db->prepare('SELECT total FROM orders WHERE DATE_FORMAT(datetime, "%Y") = ?');
$salesYear->execute([$currentYear]);
$salesDataYear = $salesYear->fetchAll(PDO::FETCH_OBJ);

$totalSales = 0;
foreach ($salesData as $order) {
    $totalSales += $order->total;
}

$totalSalesYear = 0;
foreach ($salesDataYear as $order) {
    $totalSalesYear += $order->total;
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
        <p class="datetime">Today: <span id="current-datetime"></span></p>

        <div class="dashboard-grid">
            <div class="dashboard-box" id="total-users-box">
                <h3>Total Users</h3>
                <p id="total-users"><?= count($member) ?> user</p>
            </div>

            <div class="dashboard-box" id="total-month-sales-box">
                <h3>Total Month Sales (<?= $currentMonth ?>)</h3>
                <p id="total-sales">RM <?= number_format($totalSales, 2) ?></p>
            </div>

            <div class="dashboard-box" id="total-sales-box">
                <h3>Total Year Sales (<?= $currentYear ?>)</h3>
                <p id="total-sales">RM <?= number_format($totalSalesYear, 2) ?></p>
            </div>

            <div class="dashboard-box" id="top-products-box">
                <h3>Top Products</h3>
                <div class="chart" id="top-products-chart"></div> <!-- 这里放置图表 -->
            </div>

            <div class="dashboard-box" id="revenue-breakdown-box">
                <h3>Revenue Breakdown</h3>
                <div class="chart" id="revenue-breakdown"></div> <!-- 这里放置图表 -->
            </div>

            <div class="dashboard-box" id="recent-activity-box">
                <h3>Recent Activity</h3>
                <ul>
                    <li>User Jane Doe registered</li>
                    <li>Order #12345 placed</li>
                    <li>User John flagged for review</li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>
