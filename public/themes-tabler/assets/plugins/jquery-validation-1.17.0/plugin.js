require.config({
    shim: {
        'jquery-validation': ['additional-methods', 'jquery'],
    },
    paths: {
        'jquery-validation': 'assets/plugins/jquery-validation-1.17.0/dist/jquery.validate.min',
        'additional-methods': 'assets/plugins/jquery-validation-1.17.0/dist/additional-methods.min',
    }
});