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
            ],
            borderColor: [
                'rgba(75, 192, 192, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 205, 86, 1)',
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
