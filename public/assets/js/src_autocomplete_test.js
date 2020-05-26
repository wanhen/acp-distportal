
$(document).ready(
    function()
    {
        LoadBootstrapValidatorScript(ValidateCustomer);
    
        // add new customer, shwo modal
        $('#btnadd').click(function()
        {
            browseModal();
        })
       
        
        // cust Id auto number
        $("#HospitalId").attr('readonly','readonly');
    
        if ($('#HospitalId').val() !== '')
        {
            
                 
            $.getJSON(SITE_URL+'/json_data/customer/'+$('#HospitalId').val(), function(data) {
                if (data !== null)
                {
                    $("#Hospitald").val(data.HospitalId);
                    $("#HospitalName").val(data.HospitalName);
                    $("#Category").val(data.Category);
                    $("#Address").val(data.Address);
                    $("#CityId").val(data.CityId);
                    $("#City").val(data.City);
                    $("#Province").val(data.Province);
                    $("#OwnedBy").val(data.OwnedBy);
                    $("#OwnedType").val(data.OwnedType);
                    
                    $("#Phone").val(data.Phone);
                    $("#Email").val(data.Email);
                    $("#Website").val(data.Website);
    
                    $("#NumOfBeds").val(data.NumOfBeds);
                    
                } else {
                    ClearForm();
                }
            });              
        } else {
    
            // new Prospect
            $("#btnprint").hide();        
        }
    
       
        
         // print this prospect
        $('#btnprint').click(function()
        {
           window.open(SITE_URL+'/topdf/customer_pdf/'+$("#HospitalId").val(),'_blank');  
          
        })
    
       // select city
       function split( val ) {
          return val.split( /,\s*/ );
        }
        function extractLast( term ) {
          return split( term ).pop();
        }
     
        // Auto Complete : City
        $( "#City" )
          // don't navigate away from the field on tab when selecting an item
          .bind( "keydown", function( event ) {            
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
    
              event.preventDefault();
            }
          })
          .autocomplete({
            source: function( request, response ) {
              $.getJSON( SITE_URL +"/json_data/autocomplete_city/"+$('#City').val(), {
                //$.getJSON( BASE_URL +"/tmp_search.php", {
                term: extractLast( request.term )
              }, response );
            },
            search: function() {
              // custom minLength
              var term = extractLast( this.value );
              if ( term.length < 2 ) {
                return false;
              }
            },
            focus: function() {
              // prevent value inserted on focus
              return false;
            },
            select: function( event, ui ) {
              var terms = split( this.value );
              // remove the current input
              terms.pop();
              // add the selected item
              terms.push( ui.item.value );
              // add placeholder to get the comma-and-space at the end
              terms.push( "" );
              this.value = terms.join( ", " );
    
              $('#City').val(ui.item.label);
              $('#Province').val(ui.item.Province);
              $('#CityId').val(ui.item.CityId);
              return false;
            }
          })
           .data('ui-autocomplete')._renderItem = function(ul, item) {
            return $('<li></li>')
                .data('item.ui-autocomplete', item)
                .append('<a><strong>' + item.label + '</strong><br><i><small>'+ item.Province +'</small></i></a>')
                .appendTo(ul);
        };
    
    
        // Auto Complete : Name
        $( "#HospitalName" )
          // don't navigate away from the field on tab when selecting an item
          .bind( "keydown", function( event ) {            
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
    
              event.preventDefault();
            }
          })
          .autocomplete({
            source: function( request, response ) {
              $.getJSON( SITE_URL +"/json_data/autocomplete_hospitalname/"+$('#HospitalName').val(), {
                //$.getJSON( BASE_URL +"/tmp_search.php", {
                term: extractLast( request.term )
              }, response );
            },
            search: function() {
              // custom minLength
              var term = extractLast( this.value );
              if ( term.length < 2 ) {
                return false;
              }
            },
            focus: function() {
              // prevent value inserted on focus
              return false;
            },
            select: function( event, ui ) {
              var terms = split( this.value );
              // remove the current input
              terms.pop();
              // add the selected item
              terms.push( ui.item.value );
              // add placeholder to get the comma-and-space at the end
              terms.push( "" );
              this.value = terms.join( ", " );
    
              //alert(ui.item.Category.toUpperCase());
              $('#HospitalName').val(ui.item.label);
              $('#HospitalId').val(ui.item.value);
              $('#Category').val(ui.item.Category.toUpperCase());
              $('#Address').val(ui.item.Address);          
              $('#CityId').val(ui.item.CityId);          
              $('#City').val(ui.item.City);
              $('#Province').val(ui.item.Province);
              $('#OwnedBy').val(ui.item.OwnedBy);
              $('#OwnedType').val(ui.item.OwnedType);
              $('#Phone').val(ui.item.Phone);
              $('#Email').val(ui.item.Email);
              $('#Website').val(ui.item.Website);
              $('#NumOfBeds').val(ui.item.NumOfBeds);
              return false;
            }
          })
           .data('ui-autocomplete')._renderItem = function(ul, item) {
            return $('<li></li>')
                .data('item.ui-autocomplete', item)
                .append('<a><strong>' + item.label + '</strong><br><i><small>'+ item.HospitalId +'</small></i></a>')
                .appendTo(ul);
        };
        
    })
    
    
    function ClearForm()
    {
        $("#Hospitald").val('');
        $("#HospitalName").val('');
        $("#Category").val('');
        $("#Address").val('');
        $("#CityId").val('');
        $("#City").val('');
        $("#Province").val('');
        $("#OwnedBy").val('');
        $("#OwnedType").val('0');
        
        $("#Phone").val('');
        $("#Email").val('');
        $("#Website").val('');
        $("#NumOfBeds").val('0');
    }
    
    
    
    function ValidateCustomer()
        {
            $('#activeForm')
            .bootstrapValidator({
               container: '#messages',
                message: 'This value is not valid',
                feedbackIcons: {
                        valid: 'fa fa-check',
                        invalid: 'fa fa-times',
                        validating: 'fa fa-refresh'
                    },
                fields: {
                    
                    HospitalId: {
                        message: 'HospitalId is not valid',
                        validators: {
                            notEmpty: {
                                message: 'HospitalId is required and can\'t be empty'
                            }
                        }
                    },
    
                    HospitalName: {
                        message: 'Hospital Name is not valid',
                        validators: {
                            notEmpty: {
                                message: 'Hospital Name is required and can\'t be empty'
                            }
                        }
                    }
                },
    
                onError: function(e) {
                        // Do something ...
                },
                onSuccess: function(e) {
                    // Do something ...
                    
                }
            })
    
        .on('success.form.bv', function(e) {
                e.preventDefault();
                 // get values from FORM
                var HospitalId = $("#HospitalId").val();
                var HospitalName = $("#HospitalName").val();
                var Category = $("#Category").val();
                var Address = $("#Address").val();
                var CityId = $("#CityId").val();
                var City = $("#City").val();
                var Province = $("#Province").val();
                var OwnedBy = $("#OwnedBy").val();
                var OwnedType = $("#OwnedType").val();
                
                var Phone = $("#Phone").val();
                var Email = $("#Email").val();
                var Website = $("#Website").val();
                var NumOfBeds = $("#NumOfBeds").val();
    
                bootbox.confirm("Are you sure to save customer ?", function(result) {
                if (result == true) 
                {
                
                                        
                $.ajax({
                    url: SITE_URL+"/customer/submit",
                    type: "POST",
                    dataType:"json",
                    data: {
                        HospitalId : HospitalId,
                        HospitalName : HospitalName, 
                        Category : Category,
                        Address : Address,
                        CityId : CityId,
                        City : City,
                        Province : Province,
                        OwnedBy : OwnedBy,
                        OwnedType : OwnedType,
                        Phone : Phone,
                        Email : Email,
                        Website : Website,
                        NumOfBeds : NumOfBeds                      
                    },                              
                    cache: false,
                    success: function(response) {  
                        //console.log(response.status);                  
                        // Success message
                        
                        if(response.status === "success") {
                            Redirect(SITE_URL+'/customer');
                        } else if(response.status === "error") {
                            
                        };
                       
                        // reset validation    
                        $('#activeForm').bootstrapValidator('resetForm', true);
    
                        //clear all fields
                        $('#activeForm').trigger("reset");
                        
                    },
                    error: function(response) {
                        console.log(response);
                        //alert(response);
                        // Fail message
                      
                    },
                })
    
              }})
    
            })
        }
    