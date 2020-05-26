requirejs(['jquery','jquery-ui','jquery-confirm','bootstrap-table'], function () {
 
      $('#period').on('change',function(e) {
        e.preventDefault(); // cancel submission
      
        $.ajax({
            url: baseAppUrl+"/setperiodsession/",
            data : { period: $('#period').val()},
            method : 'POST',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) { 
                //$.alert('success');
                location.reload(); 
            },
            error: function (data) { 
                $.alert('fail'); 
            }
        });
      })

      $.ajax({
        url: baseAppUrl + "/jsonchart/stt/by_period_by_dist",
        method: "GET",
        success: function(data) {
            console.log(data);

           
            
      
          }
      });


    


    
});


 // c3 Charting BOF
require(['c3', 'jquery'], function(c3, $) {
  $(document).ready(function()
  {

      $.ajax({
        url: baseAppUrl + "/jsonchart/stt/by_brand_by_dist",
        method: "GET",
        success: function(response) {
            
          var data = {};
          var lists = [];
          response.forEach(function (e) {

              lists.push(e.brand);
              data[e.brand] =  e.amount;
          });

          var chart1 = c3.generate({
            bindto: '#pie-chart-sales-by-brand',
            data: {
                json: [data],
                type : 'pie',
                keys: {
                    value: lists
                },
                colors: {
                  'Koepoe': tabler.colors["yellow"],
                  'Dua Belibis': tabler.colors["red"]
                },
                names: {
                    // name of each serie
                  'Koepoe': 'Koepoe-koepoe',
                  'Dua Belibis': 'Saos Dua Belibis'
                },
            }
          });  
      
          }
      });

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