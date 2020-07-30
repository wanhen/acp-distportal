requirejs(['jquery','jquery-ui','jquery-confirm','bootstrap-table','c3'], function () {

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

      $('#mytable').bootstrapTable({
        // url: 'data1.json',
        pagination: true,
        search: true,
        // columns: [{
        //   field: 'id',
        //   title: 'Item ID'
        // }, {
        //   field: 'name',
        //   title: 'Item Name'
        // }, {
        //   field: 'price',
        //   title: 'Item Price'
        // }]
      })
   
});