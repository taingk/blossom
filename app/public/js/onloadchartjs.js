window.onload = function() {
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myLine = new Chart(ctx, config);

    var ctx2 = document.getElementById("chart-area").getContext("2d");
    window.myPie = new Chart(ctx2, config2);

    var ctx3 = document.getElementById("canvas2").getContext("2d");
    window.myMixedChart = new Chart(ctx3, {
        type: 'bar',
        data: chartData,
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Chart.js Combo Bar Line Chart'
            },
            tooltips: {
                mode: 'index',
                intersect: true
            }
        }
    });

    var ctx4 = document.getElementById("chart-area2");
    window.myPolarArea = Chart.PolarArea(ctx4, config3);
};