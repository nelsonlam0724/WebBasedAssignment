<?php
include '../_base.php';
include '../_head.php';
include '../include/sidebarAdmin.php';
auth('Root', 'Admin');
$topSalesData = $_db->query('
    SELECT p.name AS product_name, SUM(od.unit) AS total_units, p.price AS product_price
    FROM orders AS o
    JOIN order_details AS od ON o.id = od.order_id
    JOIN product AS p ON od.product_id = p.product_id
    GROUP BY od.product_id
    ORDER BY total_units DESC
    LIMIT 10
')->fetchAll(PDO::FETCH_OBJ);

$productNames = [];
$totalUnits = [];
$totalPrices = [];

// Initialize variables for date filtering
$start_date = isset($_GET['start_date']) ? trim($_GET['start_date']) : '';
$end_date = isset($_GET['end_date']) ? trim($_GET['end_date']) : '';

// Start constructing the query
$query = 'SELECT p.name AS product_name, SUM(od.unit) AS total_units, p.price AS product_price
    FROM orders AS o
    JOIN order_details AS od ON o.id = od.order_id
    JOIN product AS p ON od.product_id = p.product_id
    WHERE 1=1';
$params = [];

if ($start_date) {
    $query .= ' AND o.datetime >= ?';
    $params[] = $start_date;
}

if ($end_date) {
    $query .= ' AND o.datetime <= ?';
    $params[] = $end_date;
}

$query .= ' GROUP BY od.product_id ORDER BY total_units DESC LIMIT 10';

$ord = $_db->prepare($query);
$ord->execute($params);
$orders = $ord->fetchAll();

// foreach ($orders as $order) {
//     $statuses[] = $order->status;
//     $counts[] = $order->count;
// }

foreach ($orders as $data) {
    $productNames[] = $data->product_name;
    $totalUnits[] = $data->total_units;
    $totalPrices[] = $data->total_units * $data->product_price; // Calculate total price
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Sales</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            margin-left: 200px;
        }

        .charts {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
        }

        .chart-container {
            width: 80%;
            height: 400px;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        h3 {
            text-align: center;
        }
    </style>
</head>

<body>

    <h1>Top Sales</h1>
    <!-- Filter and Sorting Options -->
    <div class="filter-sorting">
        <form action="topProductSalesChart.php" method="get">
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" onchange="this.form.submit()" value="<?= htmlspecialchars($start_date) ?>">
            
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" onchange="this.form.submit()" value="<?= htmlspecialchars($end_date) ?>">
        </form>
    </div>

    <div class="charts">
        <div class="chart-container">
            <h3>Units Sold - Pie Chart</h3>
            <canvas id="topSalesPieChart"></canvas>
        </div>

        <div class="chart-container">
            <h3>Units Sold - Bar Chart</h3>
            <canvas id="topSalesBarChart"></canvas>
        </div>
    </div>

    <div class="charts">
        <div class="chart-container">
            <h3>Total Prices - Pie Chart</h3>
            <canvas id="totalPricePieChart"></canvas>
        </div>

        <div class="chart-container">
            <h3>Total Prices - Bar Chart</h3>
            <canvas id="totalPriceBarChart"></canvas>
        </div>
    </div>

    <script>
        const productNames = <?php echo json_encode($productNames); ?>;
        const totalUnits = <?php echo json_encode($totalUnits); ?>;
        const totalPrices = <?php echo json_encode($totalPrices); ?>;
    </script>
    <script src="../js/topSales.js"></script>
</body>

</html>