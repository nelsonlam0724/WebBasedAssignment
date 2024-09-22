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