$(document).ready(function () {
    var ctx = document.getElementById("monthlyHarvestChart").getContext("2d");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartData['labels'])!!
},
    datasets: [{
        label: 'Monthly Harvest',
        data: {!! json_encode($chartData['data'])!!},
backgroundColor: 'rgba(78, 115, 223, 0.05)',
    borderColor: 'rgba(78, 115, 223, 1)',
        borderWidth: 2,
            pointRadius: 3,
                pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointBorderColor: 'rgba(78, 115, 223, 1)',
                        pointHoverRadius: 4,
                            pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                                pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                                    pointHitRadius: 10,
                                        pointBorderWidth: 2,
            }]
        },
options: {
    responsive: true,
        maintainAspectRatio: false,
            scales: {
        xAxes: [{
            gridLines: {
                display: false
            }
        }],
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
    },
    legend: {
        display: false
    }
}
    });
});
