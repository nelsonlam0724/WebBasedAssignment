<?php
include '../_base.php';
include '../_head.php';
include '../include/sidebarAdmin.php';

$topSalesData = $_db->query('
    SELECT p.name AS product_name, SUM(od.unit) AS total_units, p.price AS product_price
    FROM order_details AS od
    JOIN product AS p ON od.product_id = p.product_id
    GROUP BY od.product_id
    ORDER BY total_units DESC
    LIMIT 10
')->fetchAll(PDO::FETCH_OBJ);

$productNames = [];
$totalUnits = [];
$totalPrices = [];

foreach ($topSalesData as $data) {
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

        // Pie Chart for Units Sold
        const ctxPie = document.getElementById('topSalesPieChart').getContext('2d');
        const topSalesPieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: productNames,
                datasets: [{
                    label: 'Top Sales (Units Sold)',
                    data: totalUnits,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(201, 203, 207, 0.2)',
                        'rgba(99, 255, 132, 0.2)',
                        'rgba(132, 99, 255, 0.2)',
                        'rgba(255, 132, 99, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(201, 203, 207, 1)',
                        'rgba(99, 255, 132, 1)',
                        'rgba(132, 99, 255, 1)',
                        'rgba(255, 132, 99, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    }
                }
            }
        });

        // Bar Chart for Units Sold
        const ctxBar = document.getElementById('topSalesBarChart').getContext('2d');
        const topSalesBarChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: productNames,
                datasets: [{
                    label: 'Top Sales (Units Sold)',
                    data: totalUnits,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(255, 205, 86, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)',
                        'rgba(201, 203, 207, 0.7)',
                        'rgba(99, 255, 132, 0.7)',
                        'rgba(132, 99, 255, 0.7)',
                        'rgba(255, 132, 99, 0.7)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(201, 203, 207, 1)',
                        'rgba(99, 255, 132, 1)',
                        'rgba(132, 99, 255, 1)',
                        'rgba(255, 132, 99, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Pie Chart for Total Prices
        const ctxPricePie = document.getElementById('totalPricePieChart').getContext('2d');
        const totalPricePieChart = new Chart(ctxPricePie, {
            type: 'pie',
            data: {
                labels: productNames,
                datasets: [{
                    label: 'Total Prices',
                    data: totalPrices,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(201, 203, 207, 0.2)',
                        'rgba(99, 255, 132, 0.2)',
                        'rgba(132, 99, 255, 0.2)',
                        'rgba(255, 132, 99, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(201, 203, 207, 1)',
                        'rgba(99, 255, 132, 1)',
                        'rgba(132, 99, 255, 1)',
                        'rgba(255, 132, 99, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    }
                }
            }
        });

        // Bar Chart for Total Prices
        const ctxPriceBar = document.getElementById('totalPriceBarChart').getContext('2d');
        const totalPriceBarChart = new Chart(ctxPriceBar, {
            type: 'bar',
            data: {
                labels: productNames,
                datasets: [{
                    label: 'Total Prices',
                    data: totalPrices,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(255, 205, 86, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)',
                        'rgba(201, 203, 207, 0.7)',
                        'rgba(99, 255, 132, 0.7)',
                        'rgba(132, 99, 255, 0.7)',
                        'rgba(255, 132, 99, 0.7)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(201, 203, 207, 1)',
                        'rgba(99, 255, 132, 1)',
                        'rgba(132, 99, 255, 1)',
                        'rgba(255, 132, 99, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>
