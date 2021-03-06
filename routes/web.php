<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// home route
// Route::get('/', function () {
//     if (in_array('DISTRIBUTOR', explode(",",Session::get('usergroup'))) == true)
//     {
//         return view('dist.home');
//     } else {
//         return view('acp.home');
//     }
    
// })->middleware('checklogin');
Route::get('/', 'HomeController@index')->middleware('checklogin');

/* auth route */
Route::get('/login', function() {
    return view('account.login')->with('page_title', 'Login Form');
});
Route::post('/account/do_login', 'AccountController@do_login');
Route::get('/account/forgotpassword', 'AccountController@forgotpassword');


Route::get('/help/docs', function() {
    return view('help');
});

// testing
Route::get('/debug', 'ValidateController@validate_stt_customer');


// hanya boleh admin yg akses
Route::middleware(['checkadmin'])->group(function () {
    Route::get('/validate/stt', 'ValidateController@validate_stt')->name('validate_stt');
    Route::get('/validate/std', 'ValidateController@validate_std')->name('validate_std');
    Route::get('/validate/std', 'ValidateController@validate_stok')->name('validate_stok');
    // admin user  
    Route::get('/admin/user', 'AccountController@user_list')->name('user_list');
    Route::get('/admin/user/entry', 'AccountController@user_entry')->name('user_entry');    
    Route::get('/account/user/edit/{id?}', 'AccountController@user_edit')->name('user_edit');
    Route::get('/account/register', 'AccountController@register')->name('register');

    Route::post('/admin/user/post', 'AccountController@user_post')->name('user_post');
    Route::post('/account/register/post', 'AccountController@register_post')->name('register_post');

    // admin 
    Route::get('/admin', 'AdminController@index');    
    Route::get('/admin/report', 'AdminController@report');  
    Route::post('/admin/approve', 'AdminController@do_validate');

    Route::get('/admin/generatedw','AdminController@generate_dw')->name('admin_generate_dw');
    
    
    // upload
    Route::get('/upload/sttadmin','UploadController@stt_admin');
    Route::get('/upload/stokadmin','UploadController@stok_admin');
    
    // validate upload by admin
    Route::get('/validate/list','ValidateController@validate_list')->name('validate_upload_list');
    Route::get('/validate/list_entry','ValidateController@validate_entry_list')->name('validate_entry_list');
    Route::get('/validate/stt/{id?}','ValidateController@validate_stt')->name('validate_stt');
    Route::post('/validate/stt', 'ValidateController@validate_stt_post')->name('validate_stt_post');
    Route::post('/validate/stt/approve', 'ValidateController@validate_stt_approve')->name('validate_stt_approve');
    Route::get('/validate/approveconfirm', 'ValidateController@validate_stt_approve_manual_confirm')->name('validate_stt_approve_manual_confirm'); 
    Route::post('/valdate/stt/approve_manual_post', 'ValidateController@validate_stt_approve_manual_post')->name('validate_stt_approve_manual_post');

    Route::get('/validate/stok/{id?}','ValidateController@validate_stok')->name('validate_stok');
    Route::post('/valdate/stok', 'ValidateController@validate_stok_post')->name('validate_stok_post');

    
});



// distributor route
Route::middleware(['checklogin'])->group(function () {

    // account route
    Route::get('/account/profile', 'AccountController@profile');
    Route::post('/account/profile/post', 'AccountController@profile_post');
    Route::get('/account/changepassword', 'AccountController@changepassword');
    Route::post('changepassword_post', 'AccountController@changepassword_post')->name('changepassword_post');
    Route::get('/account/help', 'AccountController@help');
      
    // data master
    Route::get('/datamaster/periode/{rec_edit?}', 'DatamasterController@periode');
    Route::post('/datamaster/periode/post', 'DatamasterController@periode_post');
    Route::get('/datamaster/distributor', 'DatamasterController@distributor');
    Route::get('/datamaster/distributoredit/{id?}', 'DatamasterController@distributor_edit');
    Route::post('/datamaster/distributorpost', 'DatamasterController@distributor_post');
    Route::get('/datamaster/distributorsalestarget/{id?}', 'DatamasterController@distributor_salestarget_list');
    Route::get('/datamaster/distributoritemtarget/{id?}', 'DatamasterController@distributor_itemtarget_list');
    Route::get('/datamaster/item', 'DatamasterController@item');
    Route::get('/datamaster/itemmapping', 'DatamasterController@itemmapping');    

    
    // distributor data entry
    Route::get('/dataentry/sttentry', 'DataentryController@sttentry');
    Route::get('/dataentry/sttedit/{id}', 'DataentryController@sttedit');
    Route::get('/dataentry/stttransentry', 'DataentryController@stttransentry');
    Route::get('/dataentry/stttransedit/{id}', 'DataentryController@stttransedit');
    Route::get('/dataentry/stokentry', 'DataentryController@stokentry');
    Route::get('/dataentry/stokedit/{id}', 'DataentryController@stokedit');  
    Route::get('/dataentry/stttranslist', 'DataentryController@stttranslist'); 
    Route::get('/dataentry/sttlist', 'DataentryController@sttlist');
    Route::get('/dataentry/stoklist', 'DataentryController@stoklist');
    Route::post('/dataentry/stttranspost', 'DataentryController@stttranspost');
    Route::post('/dataentry/sttpost', 'DataentryController@sttpost');
    Route::post('/dataentry/stokpost', 'DataentryController@stokpost');
    Route::get('/dataentry/deleteconfirm', 'DataentryController@deleteconfirm');    
    Route::post('/dataentry/delete', 'DataentryController@deletepost');

    // distributor data master
    Route::get('/dist/salesmanentry', 'DistController@dist_salesman_entry');
    Route::get('/dist/customerentry', 'DistController@dist_customer_entry');
    Route::post('/dist/customerpost', 'DistController@dist_customer_post');
    Route::post('/dist/salesmanpost', 'DistController@dist_salesman_post');
    Route::get('/dist/salesmanedit/{id}', 'DistController@dist_salesman_edit');
    Route::get('/dist/customeredit/{id}', 'DistController@dist_customer_edit');
    Route::get('/dist/salesmanlist', 'DistController@dist_salesman_list');
    Route::get('/dist/customerlist', 'DistController@dist_customer_list');

    // Distributor, Laporan hasil upload
    Route::get('/dist/report/upload', 'DistReportController@report_upload');  
    Route::get('/dist/report/stt', 'DistReportController@report_stt');
    Route::get('/dist/report/stok', 'DistReportController@report_stok');

    Route::get('/dist/report/salestarget', 'DistReportController@report_salestarget'); 
    Route::get('/dist/report/saleschannel', 'DistReportController@report_saleschannel'); 
    Route::get('/dist/report/newopenoutlet', 'DistReportController@report_newopenoutlet');  
    Route::get('/dist/report/productfocus', 'DistReportController@report_productfocus'); 
    Route::get('/dist/report/brand', 'DistReportController@report_brand'); 
    Route::get('/dist/report/stockratio', 'DistReportController@report_stockratio'); 
    Route::get('/dist/report/accountreceivable', 'DistReportController@report_accountreceivable'); 
    Route::get('/dist/report/expiredate', 'DistReportController@report_expiredate'); 
    Route::get('/dist/report/sttandstd', 'DistReportController@report_sttandstd'); 

    Route::get('/setperiod/{period?}','AccountController@reload_period');
    Route::post('/setperiodsession','AccountController@set_period_session');

    // Upload = boleh di lakukan oleh distributor, admin ACP atauapun ASPS
    Route::get('/upload','UploadController@home');
    Route::get('/upload/stt','UploadController@stt');
    Route::get('/upload/sttasps','UploadController@stt_asps');
    Route::get('/upload/std','UploadController@std');

    Route::post('upload_stt', 'UploadController@upload_stt')->name('upload_stt');
    Route::post('upload_stok', 'UploadController@upload_stok')->name('upload_stok');
    Route::post('upload_std', 'UploadController@upload_std')->name('upload_std');

    // export
    Route::get('/export/uploadfile','ExportController@export');
    Route::get('/export/stt','ExportController@export_stt');
    Route::get('/export/std','ExportController@export_std');

    // import    
    Route::post('import', 'UploadController@do_upload')->name('import');

    // json chart 
    Route::get('/jsonchart/stt/by_period_by_dist', 'JsonChartController@by_period_by_dist');
    Route::get('/jsonchart/stt/by_brand_by_dist', 'JsonChartController@by_brand_by_dist');

    // json record(s)
    Route::get('/json/item/{item_code?}', 'JsonController@get_item');
    Route::get('/json/stt_detail/{header_id}', 'JsonController@stt_detail');

   
    // who can access this only logged in user
    Route::get('/account/logout', 'AccountController@logout');
   
});




// testing / demo route
Route::middleware(['checklogin'])->group(function () {
    
    // koolreport
    Route::get('/report/myreport','ReportController@myreport');

    // laravel charts - https://charts.erik.cat/render_charts.html#load-the-js-library
    Route::get('/report/samplechart','ReportController@samplechart');

    // metabase   
    Route::get('/metabase/demo', 'HomeController@home_metabase');

    // koolreport
    Route::get('/test/validate','ValidateController@validate_stt_salesman');
});





