requirejs( ['jquery','jquery-ui','jquery-confirm','select2'], function() {

    // select2 bootstrap theme
    $.fn.select2.defaults.set( "theme", "bootstrap" );

    // change period
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
        // alert("changed - " + $(this).attr('name'));
        if ($(this).attr('name') == "qty1" || $(this).attr('name') == "qty2") {
            convertQty();
        }           
    });

    // END OF INIT FORM

    $('#sales_code').select2();
    $('#cust_code').select2();
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

  // edit mode
  if ($('#id').val() !== '')
  {
    loadRecord($('#id').val());
  }
        
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

function loadRecord(header_id)
{
  $.getJSON(baseAppUrl+"/json/stt_detail/"+header_id, function(data) {
    $.each(data, function(index, value) {        
        // alert(JSON.stringify(value));
        addRow(value.id, value.item_name, value.item_code, value.qty1, value.unit1, value.qty2, value.unit2, value.uom_code, value.qty, value.unit, value.discount, value.amount);
    });
  });
}

function checkRow(){

  var item_name;
  var item_code;
  var qty1;
  var unit1;
  var qty2;
  var unit2;
  var qty;
  var unit;
  var discount;
  var amount;
  item_name = $('#item_name').val();
  item_code = $('#item_code').val();
  qty1 = $('#qty1').val();
  unit1 = $('#unit1').val();
  qty2 = $('#qty2').val();
  unit2 = $('#unit2').val();
  qty = $('#qty').val();
  unit = $('#unit').val();
  discount = $('#discount').val();
  amount = $('#amount').val();

  if (item_code == "")
  {
    $.alert({
      title: 'Alert!',
      content: 'Nama produk belum di pilih!',
    });
    $('#item_code').focus();
    return false;
  }

  if (checkItem(item_code) == false)
  {
    $.alert({
      title: 'Alert!',
      content: 'Item ' + item_name + ' sudah ada daftar, tidak bisa di tambahkan lagi !',
    });    
    return false;   
  }

  if (isNaN(qty1) || qty1 == '')
  {
    $.alert({
      title: 'Alert!',
      content: 'Qty belum terisi angka !',
    });    
    $('#qty1').focus();
    return false;
  }

  if (isNaN(discount) || discount == '')
  {
    $.alert({
      title: 'Alert!',
      content: 'Discount harus berisi angka !',
    });    
    $('#discount').focus();
    return false;
  }

  if (isNaN(amount) || amount == '')
  {
    $.alert({
      title: 'Alert!',
      content: 'Jumlah nominal revenue harus berisi angka !',
    });    
    $('#amount').focus();
    return false;
  }

  return true;
}

function checkItem(item_code)
{
    // var idx = 0;
    // var rows = $('#tbl_detail tbody >tr');
    // var columns;
    // for (var i = 0; i < rows.length; i++) {
    //     columns = $(rows[i]).find('td');
    //     for (var j = 0; j < columns.length; j++) {
    //         // check duplicate item_code
    //         if (j == 2) // item_code
    //         {
    //           if ($(columns[j]).html() == item_code)
    //           {
    //             return false;
    //           }             

    //         }
             
    //     }
        
    // }

    var ret;
    ret = true;
    $('input[name^="ditem_code"]').each(function () {
      if (this.value == item_code)
      {        
        ret = false;
      };        
    });
  return ret;
}

function hitungTotal()
{
    // var idx = 0;
    // var total_discount = 0;
    // var total_amount = 0;
    // var rows = $('#tbl_detail tbody >tr');
    // var columns;
    // for (var i = 0; i < rows.length; i++) {
    //     columns = $(rows[i]).find('td');
    //     for (var j = 0; j < columns.length; j++) {
    //       if (j == 9)
    //       {
    //         total_discount = total_discount + parseFloat($(columns[9]).html());
    //       }
    //       if (j == 10) 
    //       {
    //         total_amount = total_amount + parseFloat($(columns[10]).html());
    //       }
    //     }
    // }
    // $('#total_discount').html(total_discount);
    // $('#total_amount').html(total_amount);

   
    var total_discount = 0;
    var total_amount = 0;
    
    $('input[name^="ddiscount"]').each(function () {
      total_discount = total_discount + parseFloat(this.value);     
    });
    $('input[name^="damount"]').each(function () {
      total_amount = total_amount + parseFloat(this.value);     
    });
    $('#total_discount').html(total_discount);
    $('#total_amount').html(total_amount);
}

function addHandle()
{
  var did;
  var item_name;
  var item_code;
  var qty1;
  var unit1;
  var qty2;
  var unit2;
  var uom_code;
  var qty;
  var unit;
  var discount;
  var amount;
  
  did = 0;
  item_name = $('#item_name').val();
  item_code = $('#item_code').val();
  qty1 = $('#qty1').val();
  unit1 = $('#unit1').val();
  qty2 = $('#qty2').val();
  unit2 = $('#unit2').val();
  uom_code = $('#uom_code').val();
  qty = $('#qty').val();
  unit = $('#unit').val();
  discount = $('#discount').val();
  amount = $('#amount').val();

  if (checkRow() == true)
  {
    addRow(did,item_name,item_code,qty1,unit1,qty2,unit2,uom_code,qty,unit,discount,amount);
  }
  
}

function addRow(id,item_name,item_code,qty1,unit1,qty2,unit2,uom_code,qty,unit,discount,amount)
{
   
      markup = "<tr>"         
           + "<td style=\"display:none;\"><input type=\"hidden\" name=\"did[]\" id=\"did[]\" value=\"" + id +"\"></td>"
           + "<td><input type=\"text\" name=\"ditem_name[]\" id=\"ditem_name[]\" class=\"form-control\" value=\"" + item_name + "\" readonly></td>"
           + "<td style=\"display:none;\"><input type=\"text\" name=\"ditem_code[]\" id=\"ditem_code[]\" class=\"form-control\" value=\"" + item_code + "\" readonly></td>"
           + "<td><input type=\"number\" name=\"dqty1[]\" id=\"dqty1[]\" class=\"form-control\" value=\"" + qty1 + "\" readonly></td>"
           + "<td><input type=\"text\" name=\"dunit1[]\" id=\"dunit1[]\" class=\"form-control\" value=\"" + unit1 + "\" readonly></td>"
           + "<td><input type=\"number\" name=\"dqty2[]\" id=\"dqty2[]\" class=\"form-control\" value=\"" + qty2 + "\" readonly></td>"
           + "<td><input type=\"text\" name=\"dunit2[]\" id=\"dunit2[]\" class=\"form-control\" value=\"" + unit2 + "\" readonly></td>"
           + "<td style=\"display:none;\"><input type=\"hidden\" name=\"duom_code[]\" id=\"duom_code[]\" value=\"" + uom_code +"\"><input type=\"number\" name=\"dqty[]\" id=\"dqty[]\" class=\"form-control\" value=\"" + qty + "\" readonly></td>"
           + "<td style=\"display:none;\"><input type=\"text\" name=\"dunit[]\" id=\"dunit[]\" class=\"form-control\" value=\"" + unit + "\" readonly></td>"
           + "<td><input type=\"number\" name=\"ddiscount[]\" id=\"ddiscount[]\" class=\"form-control\" value=\"" + discount + "\" readonly></td>"
           + "<td><input type=\"number\" name=\"damount[]\" id=\"damount[]\" class=\"form-control\" value=\"" + amount + "\" readonly></td>"
           + "<td><a href=\"javascript:void(0);\" onclick=\"removeRow(this);\"><i class=\"fe fe-trash-2\"></i></a></td>"
           + "</tr>"; 
      tableBody = $("#tbl_detail tbody"); 
      tableBody.append(markup);
      hitungTotal();
  
 }

 function removeRow(oButton) {
      $.confirm({
        title: 'Konfirmasi',
        content: 'Yakin mau menghapus record ?',
        buttons: {
            okay: {
                text: 'Ya',
                action: function()
                {
                  oButton.closest('tr').remove();
                }                                                    
            },
            batal: {                  
                text: 'Batal!', // With spaces and symbols
                action: function () {
                    // $.alert('You clicked on "Batal"');                        
                }
                
            }
        }
    });       
  
}

// approve confirm
function saveRecord()
{
  $.confirm({
      title: 'Confirm!',
      content: 'Yakin mau di simpan ?',
      buttons: {
          confirm: function () {
              var token =  $('meta[name="csrf-token"]').attr('content'); 
              //$.alert('Confirmed! ' + token);

              var header_id;
              var trans_no;
              var trans_date;
              var dist_code;
              var period;
              var cust_code;
              var sales_code;

              // VALIDATE DATE CHECK WITH PERIOD

              $('#frm_stt').submit();
              //return true;
          },
          cancel: function () {
              $.alert('Canceled!');
              //return false;
          }
      }
  });
}
