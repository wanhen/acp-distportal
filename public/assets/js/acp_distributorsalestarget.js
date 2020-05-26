requirejs( ['jquery','jquery-ui','jquery-confirm','select2'], function() {

    // select2 bootstrap theme
    $.fn.select2.defaults.set( "theme", "bootstrap" );
  


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

  