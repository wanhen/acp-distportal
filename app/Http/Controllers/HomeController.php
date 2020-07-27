<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use App\Models;

use App\Charts\SampleChart;

class HomeController extends Controller
{
    public function index()
    {
        if (in_array('DISTRIBUTOR', explode(",",Session::get('usergroup'))) == true)
        {
            // set dist_array session
            return $this->home_distributor();
        } else if (in_array('ADMIN', explode(",",Session::get('usergroup'))) == true) {
            return $this->home_admin();
        } else if (in_array('RSM', explode(",",Session::get('usergroup'))) == true) {
            return $this->home_rsm();
        } else if (in_array('ASPS', explode(",",Session::get('usergroup'))) == true) {
            return $this->home_asps();
        } else {
            return $this->home_default();
        }
    }

    public function home_default()
    {
        return 'homepage';
    }

    public function home_admin()
    {

        // chart
        $chart = new SampleChart;
        
        $chart->title("Total STT per- Region", $font_size = 14, $color = '#666', $bold = true, $font_family = "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif");
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

        $rec_upload = DB::table('upload_file')->select(DB::raw('upload_file.id,upload_file.dist_code, acp_distributor.dist_name, upload_file.report_date, upload_file.period, upload_file.report_type, upload_file.filename, upload_file.report_ok, upload_file.created_at, upload_file.status'))
            ->join('acp_distributor', 'upload_file.dist_code', '=', 'acp_distributor.dist_code')
            // ->where('status','PENDING')
            ->orderBy('upload_file.report_date', 'DESC')
            ->paginate(10);
        
        $rec_period = \App\Models\AcpPeriod::where('is_active', 1)
            ->orderBy('period', 'desc')
            ->get();

        $data = array(
            'page_title' => 'Homepage',
            'chart' => $chart,
            'rec_upload' => $rec_upload,
            'rec_period' => $rec_period,
        );    
        return view('acp.home_admin')->with($data);
    }

    public function home_distributor()
    {

        $register_outlet_target = 0;
        $register_outlet_real = 0;
        $noo_target = 0;
        $noo_real = 0;

        $rec_period = \App\Models\AcpPeriod::where('is_active', 1)
            ->orderBy('period', 'desc')
            ->get();
        
            $rec_upload = DB::table('upload_file')->select(DB::raw('upload_file.id,upload_file.dist_code, acp_distributor.dist_name, upload_file.report_date, upload_file.period, upload_file.report_type, upload_file.report_ok, upload_file.filename, upload_file.created_at, upload_file.status'))
            ->join('acp_distributor', 'upload_file.dist_code', '=', 'acp_distributor.dist_code')
            // ->where('status','PENDING')
            ->where('upload_file.dist_code', Session::get('dist_code'))
            ->orderBy('upload_file.report_date', 'DESC')
            ->paginate(5);

        $data = array(
            'page_title' => 'Homepage - Distributor',
            // 'chart' => $chart,
            'rec_period' => $rec_period,
            'rec_upload' => $rec_upload,
        );    

        // return view('dist.home')->with($data);
        return view('dist.home_info')->with($data);
    }

    public function home_rsm()
    {
        $rec_period = \App\Models\AcpPeriod::where('is_active', 1)
            ->orderBy('period', 'desc')
            ->get();

        $data = array(
            'page_title' => 'Homepage - RSM',
            // 'chart' => $chart,
            'rec_period' => $rec_period,
        );    
        return view('acp.home_rsm')->with($data);
    }

    public function home_asps()
    {
        $rec_period = \App\Models\AcpPeriod::where('is_active', 1)
            ->orderBy('period', 'desc')
            ->get();

        $data = array(
            'page_title' => 'Homepage - ASPS',
            // 'chart' => $chart,
            'rec_period' => $rec_period,
        );    
        return view('acp.home_asps')->with($data);
    }

    public function home_metabase()
    {
        $metabaseSiteUrl = 'http://b2b.anggana.co.id:3000';
        $metabaseSecretKey = 'd4bca7e3073870c38dce81c232a2a7d825b707fa244f74962540766fe7ed0f51';

        $signer = new \Lcobucci\JWT\Signer\Hmac\Sha256();
        $token = (new \Lcobucci\JWT\Builder())
            // ->set('resource', ['question' => 1])
            ->set('resource', ['dashboard' => 1])
            ->set('params', (object)[])
            ->sign($signer, $metabaseSecretKey)
            ->getToken();
        
            
        $iframeUrl = "$metabaseSiteUrl/embed/dashboard/$token#bordered=true&titled=true";
        // $iframeUrl = "$metabaseSiteUrl/embed/question/$token#bordered=true&titled=true";
        // dd($iframeUrl);

        $data = array(
            'iframeUrl' => $iframeUrl,
        );

        return view('acp.home_metabase')->with($data);
    }

    
}
