<?php
include '../_base.php';
include '../_head.php';
include '../include/sidebarAdmin.php'; 
auth('Root', 'Admin');

$arr = $_db->query('SELECT * FROM user WHERE role = "Member"')->fetchAll();


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
                <p id="total-users"><?= count($arr) ?></p>
            </div>

            <div class="dashboard-box" id="new-users-box">
                <h3>Total Sales This Month</h3>
                <p id="total-sales">RM 300000</p>
            </div>

            <div class="dashboard-box" id="sales-chart-box">
                <h3>Sales Performance</h3>
                <div class="chart" id="sales-chart"></div> <!-- 这里放置图表 -->
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
