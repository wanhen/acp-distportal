requirejs( ['jquery','jquery-ui','jquery-confirm','datatables'], function() {
  
    $('#mytable').DataTable({
        "responsive": true,
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "autoWidth": false,
      });

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
               
    }); 
    
  });

  