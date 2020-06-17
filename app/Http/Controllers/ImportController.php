<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ImportController extends Controller
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

    public function import_stt(Request $request)
    {
        $data = [];
        $this->validate($request, array(
            // 'uploaded_file'      => 'required'
        ));

        

        try {

            // cek tipe report, then to database model
            
            $cl = new \App\Imports\SttImport;
            $cl->dist_code = $request->dist_code;
            $cl->report_date = $request->date_report;
            $cl->period = $request->period;
            
            $result = Excel::import($cl, request()->file('uploaded_file'));



        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
            }
        }

        
        // klo gagal saat upload
        if (isset($failures)) {
            $errmsg = "Terjadi kesalahan pada file excel '".$filename."' : <ul>";
            foreach ($failures as $failure) {
                $errmsg .= "<li>Baris ke : ".$failure->row()." | "; // row that went wrong
                $errmsg .= "Field :".$failure->attribute()." | "; // either heading key (if using heading row concern) or column index
                $errmsg .= "Pesan Error :".$failure->errors()[0]." </li>"; // Actual error messages from Laravel validator
                // $errmsg .= "Value :".$failure->values()."<br />"; // The values of the row that has failed.
                if ($request->report_type == "STOK")
                {
                    // dd($failure->values());
                    $errmsg .= "<small><i>Detail item error : ".$failure->values()["item_code"]." - ".$failure->values()["by_item"]."</i></small>";
                }
            }
            $errmsg .= "</ul>Silahkan lakukan perbaikan terlebih dahulu pada file excel, kemudian di upload lagi.";

            Session::flash('error-validation', $errmsg);
            return back();

        } 

    }

    public function import_stok(Request $request)
    {
        $data = [];
        $this->validate($request, array(
            // 'uploaded_file'      => 'required'
        ));

        try {

            // cek tipe report, then to database model
           
            $cl = new \App\Imports\StokImport;
            $cl->dist_code = $request->dist_code;
            $cl->report_date = $request->date_report;
            $cl->period = $request->period;
           
            $result = Excel::import($cl, request()->file('uploaded_file'));



        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
            }
        }

     
        // klo gagal saat upload
        if (isset($failures)) {
            $errmsg = "Terjadi kesalahan pada file excel '".$filename."' : <ul>";
            foreach ($failures as $failure) {
                $errmsg .= "<li>Baris ke : ".$failure->row()." | "; // row that went wrong
                $errmsg .= "Field :".$failure->attribute()." | "; // either heading key (if using heading row concern) or column index
                $errmsg .= "Pesan Error :".$failure->errors()[0]." </li>"; // Actual error messages from Laravel validator
                // $errmsg .= "Value :".$failure->values()."<br />"; // The values of the row that has failed.
                if ($request->report_type == "STOK")
                {
                   // dd($failure->values());
                    $errmsg .= "<small><i>Detail item error : ".$failure->values()["item_code"]." - ".$failure->values()["by_item"]."</i></small>";
                }
            }
            $errmsg .= "</ul>Silahkan lakukan perbaikan terlebih dahulu pada file excel, kemudian di upload lagi.";

            Session::flash('error-validation', $errmsg);
            return back();
        }

    }

    


    public function home(Request $request)
    {
        $rec_period = DB::table('acp_period')->select(DB::raw('period as bulan, period'))
            ->where('is_active', 1)
            ->orderBy('period', 'desc')
            ->get();
            
        $data = array(
            'page_title'=>'Upload File',
            'Description'=>'Upload File',
            'author'=>'acp',
            'rec_period' => $rec_period,
            );

        return view('upload.fileupload')->with($data);

    }

    public function stt(Request $request)
    {
        $rec_period = DB::table('acp_period')->select(DB::raw('period as bulan, period'))
            ->where('is_active', 1)
            ->orderBy('period', 'desc')
            ->get();

        $data = array(
            'page_title'=>'Upload File STT',
            'Description'=>'Upload File STT',
            'author'=>'acp',
            'rec_period' => $rec_period,
            );

        return view('upload.fileuploadstt')->with($data);

    }

    public function stt_admin(Request $request)
    {
        $rec_distributor = DB::table('acp_distributor')->select(DB::raw('dist_code, dist_name'))->get();
        $rec_period = DB::table('acp_period')->select(DB::raw('period as bulan, period'))
            ->where('is_active', 1)
            ->orderBy('period', 'desc')
            ->get();

        $data = array(
            'page_title'=>'Upload File STT',
            'Description'=>'Upload File STT',
            'author'=>'acp',
            'rec_period' => $rec_period,
            'rec_distributor' => $rec_distributor,
            );

        return view('upload.fileuploadsttadmin')->with($data);

    }

    public function stok_admin(Request $request)
    {
        $rec_distributor = DB::table('acp_distributor')->select(DB::raw('dist_code, dist_name'))->get();
        $rec_period = DB::table('acp_period')->select(DB::raw('period as bulan, period'))
            ->where('is_active', 1)
            ->orderBy('period', 'desc')
            ->get();

        $data = array(
            'page_title'=>'Upload File Stok',
            'Description'=>'Upload File Stok',
            'author'=>'acp',
            'rec_period' => $rec_period,
            'rec_distributor' => $rec_distributor,
            );

        return view('upload.fileuploadstokadmin')->with($data);

    }

    public function std(Request $request)
    {
        $rec_period = DB::table('acp_period')->select(DB::raw('period as bulan, period'))
            ->where('is_active', 1)
            ->orderBy('period', 'desc')
            ->get();
            
        $data = array(
            'page_title'=>'Upload File STD ( Sale In )',
            'Description'=>'Upload File STD',
            'author'=>'acp',
            'rec_period' => $rec_period,
            );

        return view('upload.fileuploadstd')->with($data);
    }

    

}
