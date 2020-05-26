require.config({
    paths: {
        'jexcel': 'assets/plugins/jexcel/dist/js/jquery.jexcel',
        'jquery.jcalendar': 'assets/plugins/jexcel/dist/js/jquery.jcalendar',
        'jquery.csv.min': 'assets/plugins/jexcel/dist/js/jquery.csv.min',
        'excel-formula.min': 'assets/plugins/jexcel/dist/js/excel-formula.min',
    },
    shim: {
        'jexcel': ['jquery.jcalendar', 'jquery.csv.min', 'excel-formula.min'],
        },       
});
