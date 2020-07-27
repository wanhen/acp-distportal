requirejs( ['jquery','jquery-ui','jquery-confirm'], function() {

    
    
    $('#btnsave').on('click', function(e)
    {        
        $.confirm({
            title: 'Konfirmasi',
            content: 'Yakin mau di simpan?',
            buttons: {
                okay: function () {
                    text: 'Ya',
                    $("#frmperiode").submit();
                                        
                },
                batal: {                  
                    text: 'Batal!', // With spaces and symbols
                    action: function () {
                        // $.alert('You clicked on "Batal"');                        
                    }
                    
                }
            }
        });      
    })
});
