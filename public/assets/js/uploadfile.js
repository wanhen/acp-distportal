requirejs( ['jquery','jquery-ui','jquery-confirm'], function() {
      
    $( "#date_report" ).datepicker({ dateFormat: 'yy-mm-dd' });

    // klo admin ada pilihan distributor
    if ($('#dist_code') !== undefined)
    {
        $('#dist_code').on('change', function() {
            // alert($("#dist_code>option:selected").text());
            $('#dist_name').val($("#dist_code>option:selected").text());
        })
    }
  });

  
  