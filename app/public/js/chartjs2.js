var config2 = {
    type: 'pie',
    data: {
        datasets: [{
            data: [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
            ],
            backgroundColor: [
                window.chartColors.red,
                window.chartColors.orange,
                window.chartColors.yellow,
            ],
        }],
        labels: [
            "18-25 ans",
            "25-35 ans",
            "35-60 ans"
        ]
    },
    options: {
        responsive: true
    }
};
