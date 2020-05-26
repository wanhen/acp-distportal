<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{

    function export()
    {
        return Excel::download(new \App\Exports\UploadfileExport, 'uploadfile.xlsx');
    }

}