// $(document).ready(function(){
// 	$.ajax({
// 		url: "/back/admin/data",
// 		method: "GET",
// 		success: function(data) {
// 			console.log(data);
// 			var player = [];
// 			var score = [];
//
// 			for(var i in data) {
// 				player.push("Player " + data[i].playerid);
// 				score.push(data[i].score);
// 			}
//
// 			// var chartdata = {
// 			// 	labels: player,
// 			// 	datasets : [
// 			// 		{
// 			// 			label: 'Player Score',
// 			// 			backgroundColor: 'rgba(200, 200, 200, 0.75)',
// 			// 			borderColor: 'rgba(200, 200, 200, 0.75)',
// 			// 			hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
// 			// 			hoverBorderColor: 'rgba(200, 200, 200, 1)',
// 			// 			data: score
// 			// 		}
// 			// 	]
// 			// };
//
// 			// var ctx = $("#mycanvas");
//       //
// 			// var barGraph = new Chart(ctx, {
// 			// 	type: 'bar',
// 			// 	data: chartdata
// 			// });
// 		},
// 		error: function(data) {
// 			console.log(data);
// 		}
// 	});
// });

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
