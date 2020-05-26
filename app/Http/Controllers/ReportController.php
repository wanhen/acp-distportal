<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Reports\MyReport;
use App\Charts\SampleChart;


class ReportController extends Controller
{

    public function uploadlist(Request $request)
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

        return view('report.uploadlist')->with($data);
    }

    public function home()
    {
               
        $data = array(
            'page_title' => 'Laporan',
        );

        return view('report.home')->with($data);
    }

   
    public function myreport()
    {
        $report = new MyReport;
        $report->run();
        return view("report.myreport",["report"=>$report]);
    }

    public function samplechart()
    {
        $chart = new SampleChart;
        
        $chart->title("Contoh chart", $font_size = 14, $color = '#666', $bold = true, $font_family = "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif");
        $chart->labels(['One', 'Two', 'Three', 'Four']);
        $chart->dataset('My dataset', 'bar', [1, 2, 3, 4])->options([
            'color' => ['rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)'],
            'backgroundColor' => ['rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)'],
        ]);
        $chart->dataset('My dataset 2', 'line', [4, 3, 2, 1])->options([
            'color' => '#ff9900',
            'backgroundColor' => '#dddddd',
        ]);

        return view('report.samplechart', ['chart' => $chart]);
    }


   

    public function report_home(Request $request)
    {
        $data = array(
            'page_title' => 'Laporan Admin',
        );

        return view('report.reporthome')->with($data);
    }

    public function report_home_stt(Request $request)
    {
        $rec_cust = DB::table('acp_distributor')->select('dist_code', 'dist_name')           
            ->orderBy('dist_name', 'ASC')->get();

        $rec_period = DB::table('upload_stt')->select('bulan')->distinct()->get();

        $data = array(
            'page_title' => 'Laporan Admin - STT',
            'rec_cust'  => $rec_cust,
            'rec_period' => $rec_period,
        );

        return view('report.reporthome_stt')->with($data);
    }

    public function report_home_stok(Request $request)
    {
        $rec_dist = DB::table('acp_distributor')->select('dist_code', 'dist_name')            
            ->orderBy('dist_name', 'ASC')->get();

        // DB::enableQueryLog(); // Enable query log
        // $rec_period = DB::table('stok_upload')->select(DB::raw('DATE_FORMAT(report_date, "%Y%m") as bulan'))->distinct()->get();

        $rec_tanggal = DB::table('upload_stok')->select(DB::raw('DATE_FORMAT(report_date, "%Y-%m-%d") as tanggal'))->distinct()->get();

        // dd(DB::getQueryLog());

        $data = array(
            'page_title' => 'Laporan Admin - STOK',
            'rec_dist'  => $rec_dist,
            'rec_tanggal' => $rec_tanggal,
        );

        return view('report.reporthome_stok')->with($data);
    }


    public function report_home_dist(Request $request)
    {
        $rec_dist = DB::table('acp_distributor')->select('dist_code', 'dist_name')
            ->orderBy('dist_name', 'ASC')->paginate(10);

        // DB::enableQueryLog(); // Enable query log
        // $rec_period = DB::table('stok_upload')->select(DB::raw('DATE_FORMAT(report_date, "%Y%m") as bulan'))->distinct()->get();

        // $rec_tanggal = DB::table('stok_upload')->select(DB::raw('DATE_FORMAT(report_date, "%Y-%m-%d") as tanggal'))->distinct()->get();

        // dd(DB::getQueryLog());

        $data = array(
            'page_title' => 'Laporan Admin - DISTRIBUTOR',
            'rec_dist'  => $rec_dist,
        );

        return view('report.reporthome_dist')->with($data);
    }
    
}
