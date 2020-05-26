requirejs( ['jquery','jquery-ui','jquery-confirm','select2'], function() {

    // select2 bootstrap theme
    $.fn.select2.defaults.set( "theme", "bootstrap" );
  
    $('#sales_code').select2();
    $('#cust_code').select2();
    $('#item_code').select2();

    $('#item_code').on('select2:select', function (e) {
      var data = e.params.data;
      
      var selectValue = $(this).val();

      $('#item_name').val($(this).text());
      $('#sku_code').val(selectValue);
      $('#sku_code').attr('readonly', true);

      // get item info
      $.getJSON(baseAppUrl+"/json/item/"+selectValue, function(data) 
        {
          // alert(JSON.stringify(data));
          if (data.uoms !== null)
          {            
            $.each(data, function(index, value) {
              $('#uom_code').val(value.uom_code);   
              if (value.uom3 == '')
              {
                $('#unit').val(value.uom2);
              } else if (value.uom2 == '') {
                $('#unit').val(value.uom1);
              } else {
                $('#unit').val(value.uom3);
              }               
            });
          } else {
            $('#unit').val('Pcs');
          }
          
        });
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

  