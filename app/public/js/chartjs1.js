var config = {
    type: 'pie',
    data: {
        datasets: [{
            data: [
                randomScalingFactor(),
                randomScalingFactor(),
            ],
            backgroundColor: [
                window.chartColors.red,
                window.chartColors.orange,
            ],
        }],
        labels: [
            "Homme",
            "Femme",
        ]
    },
    options: {
        responsive: true
    }
};
