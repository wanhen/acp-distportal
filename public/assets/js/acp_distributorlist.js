requirejs( ['jquery','jquery-ui','jquery-confirm','datatables'], function() {
  
    $('#mytable').DataTable({
        "responsive": true,
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "autoWidth": false,
        "fixedHeader": true,
      });

        var table = $('#mytable').DataTable();
 
        $('#mytable tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );
    
       
          
  });

  