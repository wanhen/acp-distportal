requirejs( ['jquery','jquery-ui','jquery-confirm','bootstrap-table'], function() {
    
    $('#table').bootstrapTable({
        // url: 'data1.json',
        pagination: true,
        search: true,
        // columns: [{
        //   field: 'id',
        //   title: 'Item ID'
        // }, {
        //   field: 'name',
        //   title: 'Item Name'
        // }, {
        //   field: 'price',
        //   title: 'Item Price'
        // }]
      })
});

  
  