requirejs( ['jquery','jquery-ui','jquery-confirm','bootstrap-table'], function() {
  
    $('#mytable').DataTable({
        "responsive": true,
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "autoWidth": false,
      });

          
  });

  