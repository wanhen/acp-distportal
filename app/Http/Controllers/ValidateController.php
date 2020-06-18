<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ValidateController extends Controller
{
    public function index()
    {
        try {
            DB::connection()->getPdo();
            print ('ok connected');
        } catch (\Exception $e) {
            die("Could not connect to the database.  Please check your configuration. error:" . $e );
        }

    }

    public function validate_list(Request $request, $id=null)
    {
        $rec_upload = \App\Models\Uploadfile::where('status', 'PENDING')
            ->orderBy('created_at', 'DESC')
            ->get();
                
        $data = array(
            'page_title'=>'Validasi Upload',
            'Description'=>'Validasi Upload',
            'author'=>'acp',
            'rec_upload' => $rec_upload,            
            );

        return view('upload.validasiupload_list')->with($data);

       
    }

    public function validate_entry_list(Request $request, $id=null)
    {
        $rec_upload = \App\Models\Uploadfile::where('status', 'PENDING')
            ->orderBy('created_at', 'DESC')
            ->get();
                
        $data = array(
            'page_title'=>'Validasi Hasil Entry',
            'Description'=>'Validasi Hasil Entry',
            'author'=>'acp',
            'rec_upload' => $rec_upload,            
            );

        return view('upload.validasientry_list')->with($data);

       
    }

    public function validate_stt(Request $request, $id=null)
    {
        $rec_upload = \App\Models\Uploadfile::where('id', $id)->first();
        
        $rec_stt = \App\Models\UploadStt::where('dist_code', $rec_upload->dist_code)
            ->where('report_date', $rec_upload->report_date)
            ->where('period', $rec_upload->period)
            ->get();

         $data = array(
            'page_title'=>'Validasi Upload - STT',
            'Description'=>'Validasi Upload - STT',
            'author'=>'acp',
            'rec_upload' => $rec_upload,
            'rec_stt' => $rec_stt,
            );

        return view('upload.validasiupload_stt')->with($data);

       
    }

   
    public function validate_std(Request $request)
    {
        if (Session::get('dist_code') !== null) {
            $rec_upload = \App\Models\Uploadfile::where('dist_code', Session::get('dist_code'))->orderBy('created_at', 'DESC')->paginate(10);            
        } else {
            $rec_upload = \App\Models\Uploadfile::where('dist_code', null)->orderBy('created_at', 'DESC')->paginate(10);        
        };

        $data = array(
            'page_title'=>'Validasi Upload - STD',
            'Description'=>'Validasi Upload - STD',
            'author'=>'acp',
            'rec_upload' => $rec_upload,
            );

        return view('upload.validasiupload_std')->with($data);

       
    }

    
    public function validate_stt_customer(Request $request)
    {
        $period = '2020-02';
        $dist_code = '3457261';

        // $period = $request->period;
        // $dist_code = $request->dist_code;

         // cek distributor customer
        $rec_cust_stt = DB::table('upload_stt')->select(DB::raw("CONCAT(code_customer,'|',nama_customer) as k"))
            ->where('period', $period)
            ->where('dist_code', $dist_code)
            ->groupBy('code_customer')
            ->groupBy('nama_customer')
            ->get();

        $rec_cust_dist = DB::table('dist_customer')->select(DB::raw("CONCAT(cust_code,'|',cust_name) as k"))           
            ->where('dist_code', $dist_code)                    
            ->get();


        $col1[] = null;
        foreach ($rec_cust_stt as $r1)
        {
            array_push($col1, $r1->k);
        }
        
        $col2[] = null;
        foreach ($rec_cust_dist as $r1)
        {
            array_push($col2, $r1->k);
        }
        
        // diff not in stt
        $diff1 = array_diff($col1, $col2);
        // diff not in customer
        $diff2 = array_diff($col2, $col1); 

        
        $diffall[] = null;
        foreach ($diff1 as $r1)
        {
            array_push($diffall, $r1);
        }
        foreach ($diff2 as $r1)
        {
            array_push($diffall, $r1);
        }

        // intersection of array
        $sama = array_intersect($col2, $col1);
        
        dd($diff2);
        
        // insert to master customer
        foreach ($diff2 as $key)
        {
            $cust_code = explode('|', $key)[0];
            $cust_name = explode('|', $key)[1];
            DB::table('dist_customer')->insert(
                ['dist_code' => $dist_code, 'cust_code' => $cust_code, 'cust_name' => $cust_name]
            );

        }
         
    }

    public function validate_stt_salesman(Request $request)
    {
        // cek distributor sales
        $period = '2020-02';
        $dist_code = '3457261';

        // $period = $request->period;
        // $dist_code = $request->dist_code;

         // cek distributor customer
        $rec_cust_stt = DB::table('upload_stt')->select(DB::raw("CONCAT(code_salesman,'|',nama_salesman) as k"))
            ->where('period', $period)
            ->where('dist_code', $dist_code)
            ->groupBy('code_salesman')
            ->groupBy('nama_salesman')
            ->get();

        $rec_cust_dist = DB::table('dist_salesman')->select(DB::raw("CONCAT(sales_code,'|',sales_name) as k"))           
            ->where('dist_code', $dist_code)                    
            ->get();

        
        // cek yg kode salesmannya kosong.
        foreach ($rec_cust_stt as $r)
        {
            $code_salesman = explode('|', $r->k)[0];
            if ($code_salesman == '')
            {
                echo "Kode sales kosong, harus di lengkapi terlebih dahulu !";
                exit;
            }
        }


        $col1[] = null;
        foreach ($rec_cust_stt as $r1)
        {
            array_push($col1, $r1->k);
        }
        
        $col2[] = null;
        foreach ($rec_cust_dist as $r1)
        {
            array_push($col2, $r1->k);
        }
        
        // diff not in stt
        $diff1 = array_diff($col1, $col2);
        // diff not in customer
        $diff2 = array_diff($col2, $col1); 

        
        $diffall[] = null;
        foreach ($diff1 as $r1)
        {
            array_push($diffall, $r1);
        }
        foreach ($diff2 as $r1)
        {
            array_push($diffall, $r1);
        }

        // intersection of array
        $sama = array_intersect($col2, $col1);
        
        dd($rec_cust_dist);
        
        // insert to master salesman
        foreach ($diff2 as $key)
        {
            $sales_code = explode('|', $key)[0];
            $sales_name = explode('|', $key)[1];

            // klo sales_code kosong, isi dengan yg baru, lalu update tbl upload stt
            DB::table('dist_salesman')->insert(
                ['dist_code' => $dist_code, 'sales_code' => $sales_code, 'sales_name' => $sales_name]
            );

        }
    }

    public function validate_stt_post(Request $request)
    {
        $period = $request->period;
        $dist_code = $request->dist_code;

        // pastikan item di table upload stt, item_code sudah ok.
        $rec_stt_upload = DB::table('upload_stt')
            ->where('period', $period)
            ->where('dist_code', $dist_code)
            ->get();

        // delete existing
        DB::table('dist_stt_detail')->where('period',$period)->where('dist_code',$dist_code)->delete(); 
        DB::table('dist_stt_header')->where('period',$period)->where('dist_code',$dist_code)->delete(); 

        // insert to header

        foreach ($rec_stt_upload as $row)
        {
          
            // insert to detail
        }

        
    }

    public function validate_stt_approve(Request $request)
    {
        $period = $request->period;
        $dist_code = $request->dist_code;

        // pastikan item di table upload stt, item_code sudah ok.
        $rec_stt_upload = DB::table('upload_stt')
            ->where('period', $period)
            ->where('dist_code', $dist_code)
            ->get();

        // delete existing
        DB::table('dist_stt_detail')->where('period',$period)->where('dist_code',$dist_code)->delete(); 
        DB::table('dist_stt_header')->where('period',$period)->where('dist_code',$dist_code)->delete(); 

        // insert to header

        foreach ($rec_stt_upload as $row)
        {
          
            // insert to detail
        }

        
    }


    public function validate_std_post(Request $request)
    {

    }

    public function validate_stt_manual_post(Request $request)
    {

    }
    
}
