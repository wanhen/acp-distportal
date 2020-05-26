requirejs(['jquery','jquery-ui','chartjs','c3'], function () {

    var data = {
        labels: ["2013", "2014", "2014", "2015", "2016", "2017"],
        datasets: [{
          label: '# of Votes',
          data: [10, 19, 3, 5, 2, 3],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }]
      };

      var options = {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        },
        legend: {
          display: false
        },
        elements: {
          point: {
            radius: 0
          }
        }
    
      };

      // var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
      // var lineChart = new Chart(lineChartCanvas, {
      //   type: 'line',
      //   data: data,
      //   options: options
      // });



      $.ajax({
        url: baseAppUrl + "/jsonchart/stt/by_period_by_dist",
        method: "GET",
        success: function(data) {
            console.log(data);

            var coloR = [];

            var dynamicColors = function() {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                return "rgb(" + r + "," + g + "," + b + ")";
            };

            var label = [];
            var value = [];
            for (var i in data) {
                label.push(data[i].period);
                value.push(data[i].amount);
                coloR.push(dynamicColors());
            }

            
           var dataBar = {
              labels: label,
              datasets: [{
                label: '# Penjualan',
                data: value,
                backgroundColor: coloR,
                borderColor: [
                  'rgba(255,99,132,1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
              }]
            };

          
            var ctx = document.getElementById('barChart').getContext('2d');
            var barChart = new Chart(ctx, {
                type: 'bar',
                data: dataBar,
                options: {
                  scales: {
                    yAxes: [{
                      ticks: {
                        beginAtZero: true
                      }
                    }]
                  },
                  legend: {
                    display: false,
                    position: 'bottom',
                  }
              }
            });

            
      
        }
    });


    $.ajax({
      url: baseAppUrl + "/jsonchart/stt/by_brand_by_dist",
      method: "GET",
      success: function(data) {
          console.log(data);

          var coloR = [];

          var dynamicColors = function() {
              var r = Math.floor(Math.random() * 255);
              var g = Math.floor(Math.random() * 255);
              var b = Math.floor(Math.random() * 255);
              return "rgb(" + r + "," + g + "," + b + ")";
          };

          var label2 = [];
          var value2 = [];
          for (var i in data) {
              label2.push(data[i].brand);
              value2.push(data[i].amount);
              coloR.push(dynamicColors());
          }

          
          var dataBarBrand = {
            labels: label2,
            datasets: [{
              label: '# Penjualan',
              data: value2,
              backgroundColor: coloR,              
            }]
          };

        
          var ctx = document.getElementById('barChartBrand').getContext('2d');
          var barChart = new Chart(ctx, {
              type: 'pie',
              data: dataBarBrand,
              options: {
                // scales: {
                //   yAxes: [{
                //     ticks: {
                //       beginAtZero: true
                //     }
                //   }]
                // },
                legend: {
                  onClick: function (evt, item) {
                    alert('legend onClick: event:' + evt+'item :'+ item.text);
                    },
                  position: 'bottom',
                  // onClick: function(alert('test')),
                  display: true
                }
            }
          });

          
    
      }
  });


    
});


 // c3 Charting BOF
require(['c3', 'jquery'], function(c3, $) {
  $(document).ready(function(){
    var chart = c3.generate({
      bindto: '#chart-pie', // id of chart wrapper
      data: {
        columns: [
            // each columns data
          ['data1', 63],
          ['data2', 44],
          ['data3', 12],
          ['data4', 14]
        ],
        type: 'pie', // default type of chart
        colors: {
          'data1': tabler.colors["blue-darker"],
          'data2': tabler.colors["blue"],
          'data3': tabler.colors["blue-light"],
          'data4': tabler.colors["blue-lighter"]
        },
        names: {
            // name of each serie
          'data1': 'A',
          'data2': 'B',
          'data3': 'C',
          'data4': 'D'
        }
      },
      axis: {
      },
      legend: {
                show: true, //hide legend
      },
      padding: {
        bottom: 0,
        top: 0
      },
    });
    });
});

// c3 Charting EOF