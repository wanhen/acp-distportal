require.config({
    paths: {
        'datatables': 'assets/plugins/datatables/js/datatables.min',
        'datatables.bootstrap': 'assets/plugins/datatables/js/DataTables-1.10.18/js/dataTables.bootstrap.min', 
        'datatables.net-buttons': 'assets/plugins/datatables/js-simple/Buttons-1.5.2/js/dataTables.buttons.min',
        'datatables.net-buttons-bs': 'assets/plugins/datatables/js-simple/Buttons-1.5.2/js/buttons.bootstrap.min',                  
    },      
    shim: {
        'bootstrap': {
          deps: ['jquery']
        },
      },
      map: {
        '*': {
          'datatables.net': 'datatables',
        }
      },
});


