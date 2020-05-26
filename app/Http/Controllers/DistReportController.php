<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class DistReportController extends Controller
{
    

    public function report_upload(Request $request)
    {        
        if (Session::get('dist_code') !== null) {
            $rec_upload = \App\Models\Uploadfile::where('dist_code', Session::get('dist_code'))->orderBy('created_at', 'DESC')->paginate(10);            
        } else {
            $rec_upload = \App\Models\Uploadfile::where('dist_code', null)->orderBy('created_at', 'DESC')->paginate(10);        
        }
        $data = array(
            'page_title' => 'Laporan Upload List',
            'rec_upload' => $rec_upload,
        );

        return view('laporan.uploadlist')->with($data);
    }

    public function report_stt(Request $request)
    {        
        if (Session::get('dist_code') !== null) {
            $rec_upload = \App\Models\Uploadfile::where('dist_code', Session::get('dist_code'))->orderBy('created_at', 'DESC')->paginate(10);            
        } else {
            $rec_upload = \App\Models\Uploadfile::where('dist_code', null)->orderBy('created_at', 'DESC')->paginate(10);        
        }
        $data = array(
            'page_title' => 'Laporan STT',
            'rec_upload' => $rec_upload,
        );

        return view('laporan.uploadlist')->with($data);
    }

    public function report_stok(Request $request)
    {        
        if (Session::get('dist_code') !== null) {
            $rec_upload = \App\Models\Uploadfile::where('cust_id', Session::get('dist_code'))->orderBy('created_at', 'DESC')->paginate(10);            
        } else {
            $rec_upload = \App\Models\Uploadfile::where('cust_id', null)->orderBy('created_at', 'DESC')->paginate(10);        
        }
        $data = array(
            'page_title' => 'Laporan Stok',
            'rec_upload' => $rec_upload,
        );

        return view('laporan.uploadlist')->with($data);
    }

    public function report_salestarget(Request $request)
    {
        $data = array(
            'page_title' => 'Sales Target',
        );

        return view('dist.report_sales_target')->with($data);
    }

    public function report_saleschannel(Request $request)
    {
        $data = array(
            'page_title' => 'Sales by Channel',
        );

        return view('dist.report_sales_channel')->with($data);
    }

    public function report_newopenoutlet(Request $request)
    {
        $data = array(
            'page_title' => 'New Open Outlet',
        );

        return view('dist.report_sales_newopenoutlet')->with($data);
    }

    public function report_productfocus(Request $request)
    {
        $data = array(
            'page_title' => 'Product Focus',
        );

        return view('dist.report_sales_productfocus')->with($data);
    }

    public function report_brand(Request $request)
    {
        $data = array(
            'page_title' => 'Brand',
        );

        return view('dist.report_sales_brand')->with($data);
    }

    public function report_stockratio(Request $request)
    {
        $data = array(
            'page_title' => 'Stock Ratio',
        );

        return view('dist.report_sales_stockratio')->with($data);
    }

    public function report_accountreceivable(Request $request)
    {
        return "Under construction";
    }

    public function report_expiredate(Request $request)
    {
        return "Under construction";
    }

    public function report_sttandstd(Request $request)
    {
        return "Under construction";
    }

}
