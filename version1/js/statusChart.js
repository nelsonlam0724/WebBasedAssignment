const ctx = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: statuses,
                datasets: [{
                    label: 'Order Status',
                    data: counts,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)', 
                        'rgba(255, 99, 132, 0.6)', 
                        'rgba(255, 205, 86, 0.6)', 
                        'rgba(54, 162, 235, 0.6)', 
                        'rgba(153, 102, 255, 0.6)'  
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });

        const ctxx = document.getElementById('statusBarChart').getContext('2d');
        const statusBarChart = new Chart(ctxx, {
            type: 'bar',
            data: {
                labels: statuses,
                datasets: [{
                    label: 'Order Status Count',
                    data: counts,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(255, 205, 86, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(153, 102, 255, 0.7)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1,
                    barPercentage: 0.7,
                    categoryPercentage: 0.7,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                elements: {
                    bar: {
                        borderSkipped: false,
                        borderRadius: 15,
                        hoverBorderWidth: 3
                    }
                }
            }
        });