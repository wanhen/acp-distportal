requirejs( ['jquery','jquery-ui','select2','jquery-confirm'], function() {
  
    $('#dist_code').select2();

    $('#userlevel').on('change', function() {
        // alert($(this).val());
        switch($(this).val())
        {
            case "DISTRIBUTOR":                
                $('#dist_code').removeAttr('disabled');
                break;
            case "ASPS":
                $('#dist_code').val('').change();
                $('#dist_code').attr('disabled', true);
                break;
            case "RSM":
                $('#dist_code').val('').change();
                $('#dist_code').attr('disabled', true);
                break;
            default:                
                $('#dist_code').val('').change();
                $('#dist_code').attr('disabled', true);
                break;
        }
    })
  
    $('#btnsubmit').on("click",function(e){      
        var form = $(this);
        $.confirm({
            buttons: {
                okay: function () {
                    // here the button key 'hey' will be used as the text.
                    text: 'Simpan',
                    // $.alert('You clicked on "Okay".');
                    $("#frmnewuser").submit();
                                        
                },
                batal: {                  
                    text: 'Batal!', // With spaces and symbols
                    action: function () {
                        // $.alert('You clicked on "Batal"');                        
                    }
                    
                }
            }
        });                
    });
      
  });
  