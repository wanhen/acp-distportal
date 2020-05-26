<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class JsonController extends Controller
{
    public function index()
    {
        
    }

    public function get_item($item_code=null)
    {
        $data = \App\Models\AcpItem::with(['uoms'])->where('item_code', $item_code)->first();

        return response()->json($data);
    }

    public function dist_customer($dist_code=null)
    {
        $data = \App\Models\dist_customer::select('cust_code', 'cust_name')->where('dist_code', $dist_code)
                ->orderBy('cust_name', 'asc')
                ->get();        
         
        return response()->json($data);
    }

    public function dist_customer_select2($dist_code=null)
    {
        $data = \App\Models\dist_customer::select('cust_code', 'cust_name')->where('dist_code', $dist_code)
                ->orderBy('cust_name', 'asc')
                ->get();
                
       
        return response()->json(['results' => $data],201);
    }

    public function dist_salesman_select2($dist_code=null)
    {
        $data = \App\Models\dist_customer::select('sales_code', 'sales_name')->where('dist_code', $dist_code)
                ->orderBy('sales_name', 'asc')
                ->get();
                
       
        return response()->json(['results' => $data],201);
    }

    public function acp_item_select2($brand=null)
    {
        $data = \App\Models\dist_customer::select('item_code', 'item_name', 'brand')->where('brand', $brand)
                ->orderBy('item_name', 'asc')
                ->get();
                
       
        return response()->json(['results' => $data],201);
    }

    public function stt_detail($header_id=null)
    {
        $data = DB::table('vw_dist_stt_detail')
            ->where('header_id', $header_id)->get();

        return response()->json($data);
    }

    

}
