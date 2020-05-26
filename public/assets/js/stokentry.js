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

     // all input change event
     $(":input").bind('keyup mouseup', function () {
        
        if ($(this).attr('name') == "qty1" || $(this).attr('name') == "qty2") {
            convertQty();
        }           
    });
  
    $('#item_code').select2();

    $('#item_code').on('select2:select', function (e) {
      var data = e.params.data;
      
      var selectValue = $(this).val();
      var selectedText = $("#item_code option:selected").html();
      
      $('#item_name').val(selectedText);
      $('#sku_code').val(selectValue);
      $('#sku_code').attr('readonly', true);

      fillUOM(selectValue);
     
    });
    
});


function fillUOM(item_code)
{
   // get item info
   $.getJSON(baseAppUrl+"/json/item/"+item_code, function(data) 
   {
     // alert(JSON.stringify(data));
     if (data.uoms !== null)
     {            
       $('#uom_code').val(data.uoms.uom_code);   
       // alert(data.uoms.uom_code + ' - ' + data.uoms.uom3 + ' - ' + data.uoms.uom2 + ' - ' + data.uoms.uom1);
       
       $('#qty2').removeAttr('readonly');
       $('#qty1').removeAttr('readonly');
       $('#unit2').attr('readonly','readonly');
       $('#unit1').attr('readonly','readonly');
       $('#unit2').val('');
       $('#unit1').val('');

       $('#qty1').val('0');         
       $('#qty2').val('0');
       $('#qty').val('0');
       $('#discount').val('0');
       $('#amount').val('0');

       var last_unit;           
       if (data.uoms.uom3 !== '' && data.uoms.uom2 !== '')
       {
         $('#unit2').val(data.uoms.uom3);  
       }
       if (data.uoms.uom2 !== '' && data.uoms.uom3 == '') {
         $('#unit2').val(data.uoms.uom2);                                           
       } else {
         $('#unit2').val(data.uoms.uom3);
       }
       if (data.uoms.uom1 !== '') {
         $('#unit1').val(data.uoms.uom1);
       }    
       
       // hide not exitst
       $('#unit').val($('#unit2').val());    
       if ($('#unit2').val() == '')
       {
         $('#qty2').val('');
         $('#unit2').val('');
         $('#qty2').attr('readonly','readonly');             
         $('#unit').val($('#unit1').val());             
       } 
       if ($('#unit1').val() == '')
       {
         $('#qty1').val('');
         $('#qty1').attr('readonly','readonly');             
       }

                 
     } else {
       alert('UOM not defined !');
       $('#unit').val('UOM Not defined');
       $('#unit').attr('placeholder', 'UOM Not defined');
     }
     
   });
}

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

        if (data.uoms.uom3 !== '' && data.uoms.uom2 !== '')
        {
          qty3 = $('#qty2').val();  
          qty2 = 0;
          qty1 = $('#qty1').val();
        } else {
          qty1 = $('#qty1').val();
          qty2 = $('#qty2').val();
          qty3 = 0;
        }

       
        
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
          qty3 = 0;
        }
        
        var qty;
        qty = qty1 + qty2 + qty3;
        
        // return qty;
        $('#qty').val(qty);

      }
  });
  
}

  