require.config({
    shim: {
        'chartjs': {
            deps: ['moment']    // enforce moment to be loaded before chartjs
        }
    },
    paths: {
        'chartjs': 'assets/plugins/chartjs/Chart.min',
        'moment': 'assets/plugins/chartjs/moment'
    }
});