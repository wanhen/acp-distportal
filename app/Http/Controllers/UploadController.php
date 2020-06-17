<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
// use App\Exports\UsersExport;
// use App\Imports\UsersImport;
use App\Imports\TempUploadImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
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

    public function upload_stt(Request $request)
    {
        $data = [];
        $this->validate($request, array(
            'uploaded_file'      => 'required'
        ));

        if($request->hasFile('uploaded_file')){
            $extension = \File::extension($request->uploaded_file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv" || $extension == "xlsm") {
                $filename = $request->uploaded_file->getClientOriginalName();

                // cek apakah sudah pernah ada di lihat dari
                // dist_code, report_date, report_type
                // lihat di table Uploadfile, where
                // kalau sudah pernah ada data & file lama di hapus
                // DB::enableQueryLog(); // Enable query log
                $rec_file = DB::connection()->table('upload_file')
                    ->where('dist_code', '=', $request->dist_code)
                    ->where('report_date','=', $request->date_report)
                    ->where('report_type', '=', $request->report_type)
                    ->where('status', 'COMPLETE') // status = PENDING, REJECT, COMPLETE
                    ->first();

                // dd(DB::getQueryLog());
                if ($rec_file !== null) {
                    // user doesn't exist
                    Session::flash('error', 'File laporan pada periode di pilih sudah terdaftar dan sudah komplit, silahkan kontak admin apabila ada yang perlu diperbaiki !');
                    return back();
                }

              
                // move file to public folder
                $uppath = 'uploadedfiles/'.$request->dist_code;
                if (! \File::exists($uppath)) {
                    \File::makeDirectory($uppath);
                }
                $request->uploaded_file->move($uppath, $request->uploaded_file->getClientOriginalName());

                // save file info
                $data =  new \App\Models\Uploadfile();

                $dt=date_create($request->date_report);
                $date_report = date_format($dt,"Y-m-d");

                $data->filename = $request->uploaded_file->getClientOriginalName();
                $data->filepath = $uppath;
                $data->report_date = $request->date_report;
                $data->period = $request->period;
                $data->report_ok = $request->report_ok;
                $data->report_type = $request->report_type;
                $data->dist_code = $request->dist_code;
                $data->dist_name = $request->dist_name;
                $data->username = Session::get('username');
                $data->status = 'PENDING';

                $data->updated_by = Session::get('username');
                $data->save();

                Session::flash('upload-success', 'File sukses diupload, menunggu di validasi oleh Admin!');
                return back();
                exit(); // apakah perlu di exit
               
            }else {
                Session::flash('error', 'File tidak valid, file yg anda submit adalah "'.$extension.'" file.!! Upload file excel xlsx/xls/csv yang valid..!!');
                return back();
            }
        }

    }

    public function upload_stok(Request $request)
    {
        $data = [];
        $this->validate($request, array(
            'uploaded_file'      => 'required'
        ));

        if($request->hasFile('uploaded_file')){
            $extension = \File::extension($request->uploaded_file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv" || $extension == "xlsm") {
                $filename = $request->uploaded_file->getClientOriginalName();

                // cek apakah sudah pernah ada di lihat dari
                // dist_code, report_date, report_type
                // lihat di table Uploadfile, where
                // kalau sudah pernah ada data & file lama di hapus
                // DB::enableQueryLog(); // Enable query log
                $rec_file = DB::connection()->table('upload_file')
                    ->where('dist_code', '=', $request->dist_code)
                    ->where('report_date','=', $request->date_report)
                    ->where('report_type', '=', $request->report_type)
                    ->where('status', 'COMPLETE') // status = PENDING, REJECT, COMPLETE
                    ->first();

                // dd(DB::getQueryLog());
                if ($rec_file !== null) {
                    // user doesn't exist
                    Session::flash('error', 'File laporan pada periode di pilih sudah diupload dan komplit, silahkan hubungi admin !');
                    return back();
                }

                

                    // move file to public folder
                    $uppath = 'uploadedfiles/stok/'.$request->dist_code;
                    if (! \File::exists($uppath)) {
                        \File::makeDirectory($uppath);
                    }
                    $request->uploaded_file->move($uppath, $request->uploaded_file->getClientOriginalName());

                    // save file info
                    $data =  new \App\Models\Uploadfile();

                    $dt=date_create($request->date_report);
                    $date_report = date_format($dt,"Y-m-d");

                    $data->filename = $request->uploaded_file->getClientOriginalName();
                    $data->filepath = $uppath;
                    $data->report_date = $request->date_report;
                    $data->period = $request->period;
                    $data->report_ok = $request->report_ok;
                    $data->report_type = $request->report_type;
                    $data->dist_code = $request->dist_code;
                    $data->dist_name = $request->dist_name;
                    $data->username = Session::get('username');
                    $data->status = 'PENDING';

                    $data->updated_by = Session::get('username');
                    $data->save();

                    Session::flash('upload-success', 'File sukses diupload, menunggu di validasi oleh Admin!');
                    return back();
                    exit(); // apakah perlu di exit
                              

            }else {
                Session::flash('error', 'File tidak valid, file yg anda submit adalah "'.$extension.'" file.!! Upload file excel xlsx/xls/csv yang valid..!!');
                return back();
            }
        }
    }

    public function upload_std(Request $request)
    {
        $data = [];
        $this->validate($request, array(
            'uploaded_file'      => 'required'
        ));

        if($request->hasFile('uploaded_file')){
            $extension = \File::extension($request->uploaded_file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv" || $extension == "xlsm") {
                $filename = $request->uploaded_file->getClientOriginalName();

               

                 // move file to public folder
                 $uppath = 'uploadedfiles/std';
                 if (! \File::exists($uppath)) {
                     \File::makeDirectory($uppath);
                 }
                //  $request->uploaded_file->move($uppath, $request->uploaded_file->getClientOriginalName());
                $file_result =  $request->file('uploaded_file')->storeAs('std', $filename, 'upload');
                
                // dd(Storage::disk('upload')->url('std/'.$filename));
                // $exists = Storage::disk('upload')->exists('std/'.$filename);
                
                try {
                    
                    // cek tipe report, then to database model                   
                    $cl = new \App\Imports\StdImport;  
                     
                    // delete old record 
                    DB::table('upload_std')
                        ->where('period', 'like', '%'.$request->period.'%')
                        ->delete();
                    
                    // $result = Excel::import($cl, request()->file('uploaded_file'));
                    $result = Excel::import($cl, 'std/'.$filename, 'upload');
                    
                } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                    $failures = $e->failures();

                    foreach ($failures as $failure) {
                        $failure->row(); // row that went wrong
                        $failure->attribute(); // either heading key (if using heading row concern) or column index
                        $failure->errors(); // Actual error messages from Laravel validator
                        $failure->values(); // The values of the row that has failed.
                    }
                }

                // dd($failures);
                if (isset($failures)) {
                    $errmsg = "Terjadi kesalahan pada file excel '".$filename."' : <ul>";
                    foreach ($failures as $failure) {
                        $errmsg .= "<li>Baris ke : ".$failure->row()." | "; // row that went wrong
                        $errmsg .= "Field :".$failure->attribute()." | "; // either heading key (if using heading row concern) or column index
                        $errmsg .= "Pesan Error :".$failure->errors()[0]." </li>"; // Actual error messages from Laravel validator
                        // $errmsg .= "Value :".$failure->values()."<br />"; // The values of the row that has failed.
                        
                    }
                    $errmsg .= "</ul>Silahkan lakukan perbaikan terlebih dahulu pada file excel, kemudian di upload lagi.";

                    Session::flash('error-validation', $errmsg);
                    return back();
                } 

                
                Session::flash('success', "File sukses di upload");
                return back();

            }else {
                Session::flash('error', 'File tidak valid, file yg anda submit adalah "'.$extension.'" file.!! Upload file excel xlsx/xls/csv yang valid..!!');
                return back();
            }
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
