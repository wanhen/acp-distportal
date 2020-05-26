<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AdminController extends Controller
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

    public function monitor(Request $request)
    {
        // $rec_fileupload = \App\Models\TempUpload::paginate(10);
        $rec_upload = \App\Models\Uploadfile::orderBy('created_at', 'DESC')->paginate(10);
        $data = array(
            'page_title' => 'Monitoring Data Upload',
            'rec_upload'=> $rec_upload,
        );

        // dd($rec_upload);
        return view('acp.monitor')->with($data);
    }

    public function validasi_upload(Request $request)
    {
        // $rec_fileupload = \App\Models\TempUpload::paginate(10);
        $rec_upload = \App\Models\Uploadfile::orderBy('created_at', 'DESC')->paginate(10);
        $data = array(
            'page_title' => 'Validasi Data Upload',
            'rec_upload'=> $rec_upload,
        );

        // dd($rec_upload);
        return view('upload.validasiupload')->with($data);
    }

    public function do_validate(Request $request)
    {

        $id = $request->id;
        $rec = \App\Models\Uploadfile::find($id);

        if ($rec) {
            $rec->status = 'APPROVED';
            $rec->save();
        }

        // Message::flash('success', 'ok');
        // back();
        return redirect('/admin/monitor');

    }

    public function generate_dw(Request $request)
    {
        return "under construction !";
    }
    

    

}
