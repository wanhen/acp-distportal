requirejs( ['jquery','jquery-ui','jquery-confirm','datatables'], function() {

    $('#mytable').DataTable({
        responsive: true,
        filter: false,
        paginate: true,        
        autoWidth: false, 
        searching: true,
        info: false,
        ordering: false               
      });
    
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
