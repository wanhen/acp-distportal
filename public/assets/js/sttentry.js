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
    })

    // all input change event
    $(":input").bind('keyup mouseup', function () {
        // alert("changed - " + $(this).attr('name'));
        if ($(this).attr('name') == "qty1" || $(this).attr('name') == "qty2" || $(this).attr('name') == "qty3") {
            convertQty();
        }           
    });

    // INIT FORM
    if ($('#unit3').val() == '')
    {
      $('#unit3').hide();
      $('#qty3').hide()
    }
   
    if ($('#unit2').val() == '')
    {
      $('#unit2').hide();
      $('#qty2').hide()
    }

    // END OF INIT FORM

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
            $('#uom_code').val(data.uoms.uom_code);   
            // alert(data.uoms.uom_code + ' - ' + data.uoms.uom3 + ' - ' + data.uoms.uom2 + ' - ' + data.uoms.uom1);
            
            $('#unit3').val('');
            $('#unit2').val('');
            $('#unit1').val('');

            $('#qty1').show();
            $('#qty2').show();
            $('#qty3').show();
            $('#unit1').show();
            $('#unit2').show();
            $('#unit3').show();

            var last_unit;           
            if (data.uoms.uom3 !== '')
            {
              $('#unit3').val(data.uoms.uom3);  
            }
            if (data.uoms.uom2 !== '') {
              $('#unit2').val(data.uoms.uom2);                                           
            }
            if (data.uoms.uom1 !== '') {
              $('#unit1').val(data.uoms.uom1);
            }    
            
            // hide not exitst
            $('#unit').val($('#unit3').val());    
            if ($('#unit3').val() == '')            {
              $('#qty3').hide();
              $('#unit3').hide();
              $('#unit').val($('#unit2').val());    
            } 
            if ($('#unit2').val() == '')
            {
              $('#qty2').hide();
              $('#unit2').hide();
              $('#unit').val($('#unit1').val());    
            } 
            if ($('#unit1').val() == '')
            {
              $('#qty1').hide();
              $('#unit1').hide();
            }

                      
          } else {
            alert('UOM not defined !');
            $('#unit').val('UOM Not defined');
            $('#unit').attr('placeholder', 'UOM Not defined');
          }
          
        });
    });
    
  });

  function convertQty()
  {
    $.getJSON(baseAppUrl+"/json/item/"+$('#item_code').val(), function(data) 
    {
      if (data.uoms !== null)
      {            
        $('#uom_code').val(data.uoms.uom_code);   
        var uom1;
        var uom2;
        var uom3;

        var bqty1;
        var bqty2;
        var bqty3;

        var qty1;
        var qty2;
        var qty3;

        uom1 = data.uoms.uom1;
        uom2 = data.uoms.uom2;
        uom3 = data.uoms.uom3;

        bqty1 = data.uoms.qty1;
        bqty2 = data.uoms.qty2;
        bqty3 = data.uoms.qty3;

        qty1 = $('#qty1').val();
        qty2 = $('#qty2').val();
        qty3 = $('#qty3').val();
        
        if (bqty3 !== 0)
        {
          qty1 = (qty1 * bqty3);
          qty2 = (qty2 * (bqty3/bqty2));
          qty3 = (qty3 * 1);
        } else if (bqty3 == 0 && bqty2 !==0) {
          qty1 = (qty1 * bqty2);
          qty2 = (qty2 * 1);
          qty3 = 0;
        } else {
          qty1 = (qty1 * 1);
          qty2 = 0;
          qty3 = 0
        };
        
        var qty;
        qty = qty1 + qty2 + qty3;
        
        // return qty;
        $('#qty').val(qty);

      }
  })
}