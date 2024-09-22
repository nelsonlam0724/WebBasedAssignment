<?php
include '../_base.php';
include '../_head.php';
require_once '../lib/SimplePager.php'; // Include SimplePager class
include '../include/sidebarAdmin.php'; 

auth('Root', 'Admin');

$arr = $_db->query('SELECT * FROM orders')->fetchAll();

$amnt = 0;

// Initialize variables
$start_date = isset($_GET['start_date']) ? trim($_GET['start_date']) : '';
$end_date = isset($_GET['end_date']) ? trim($_GET['end_date']) : '';

// Start constructing the query
$query = 'SELECT * FROM orders WHERE 1=1';
$params = [];

if ($start_date) {
    $query .= ' AND datetime >= ?';
    $params[] = $start_date;
}

if ($end_date) {
    $query .= ' AND DATE(datetime) <= ?';
    $params[] = $end_date;
}

$ord = $_db->prepare($query);
$ord->execute($params);
$orders = $ord->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <form action="generateReport.php" method="get">

                <!-- Status Filter -->
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" id="start_date" onchange="this.form.submit()" value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : '' ?>">

                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" id="end_date" onchange="this.form.submit()" value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : '' ?>">

            </form>
        </div>

        <!-- Order Table -->
        <table class="order-table">
            <tr>
                <th></th>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Order Date</th>
                <th>Total Amount</th>
            </tr>
            <?php foreach ($orders as $i => $order): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= $order->id ?></td>
                    <td data-get="userDetails.php?user_id=<?= $order->user_id ?>"><?= $order->user_id ?></td>
                    <td><?= $order->datetime ?></td>
                    <td><?= $order->total ?></td>
                </tr>
                <?php $amnt += $order->total ?>
            <?php endforeach; ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <th>Total</th>
                <td>RM<?= $amnt ?></td>
            </tr>
        </table>
        <br>
        
        <div class="action-buttons">
            <a href="admin.php"><button>Back To Menu</button></a>
            <a href="statusChart.php"><button>Status Chart</button></a>
            <a href="topProductSalesChart.php"><button>Top Product Sales Chart</button></a>
            <a href="topSalesChart.php"><button>Top Sales Chart</button></a>
        </div>
    </div>
</body>

</html>