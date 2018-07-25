window.onload = function() {
  var ctx = document.getElementById("canvas1").getContext("2d");
  fetch('/back/admin/dataage')
  .then(response => response.json().then(json => {
    window.myLine = new Chart(ctx, {
      type: 'pie',
      data: {
        datasets: [{
          data: [
            json['stats']['18:25'],
            json['stats']['25:35'],
            json['stats']['35:60']
          ],
          backgroundColor: [
            window.chartColors.red,
            window.chartColors.orange,
            window.chartColors.yellow
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
    });
  }))
};

var prev_handler = window.onload;
if (prev_handler) {
    prev_handler();
}
window.onload = function() {
    var ctx2 = document.getElementById("canvas2").getContext("2d");
    fetch('/back/admin/datagender')
    .then(response => response.json().then(json => {
      window.myLine = new Chart(ctx2, {
          type: 'pie',
          data: {
              datasets: [{
                  data: [
                    json['stats']['male'],
                    json['stats']['female']
                  ],
                  backgroundColor: [
                      window.chartColors.green,
                      window.chartColors.blue
                  ],
              }],
              labels: [
                  "Homme",
                  "Femme"
              ]
          },
          options: {
              responsive: true
          }
      });
    }));
  };
