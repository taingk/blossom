window.onload = function() {
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
            },
            title: {
                display: false,
                text: 'Chart.js Bar Chart'
            }
        }
    });

    var ctx2 = document.getElementById("canvass").getContext("2d");
    window.myLine = new Chart(ctx2, config);
};
