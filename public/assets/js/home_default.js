requirejs(['chartjs'], function () {

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
   
});