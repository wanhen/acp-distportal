<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class JsonChartController extends Controller
{
   

    public function by_period_by_dist($dist_code=null)
    {
        $data = DB::table('dist_stt')
            ->select( DB::raw("period, SUM(amount) as amount"))
            ->where('dist_stt.dist_code', Session::get('dist_code'))
            ->groupby('period')
            ->get();                
       
        // return response()->json(['results' => $data],201);
        return response()->json($data->toArray());
    }

    public function by_channel_by_dist($dist_code=null)
    {
        $data = DB::table('dist_stt')
            ->select( DB::raw("period, SUM(amount) as amount"))
            ->where('dist_stt.dist_code', Session::get('dist_code'))
            ->groupby('period')
            ->get();                
       
        // return response()->json(['results' => $data],201);
        return response()->json($data->toArray());
    }

    public function by_brand_by_dist($dist_code=null)
    {
        $data = DB::table('dist_stt')
            ->select( DB::raw("acp_item.brand, SUM(amount) as amount"))
            ->leftJoin('acp_item','dist_stt.item_code', '=', 'acp_item.item_code')            
            ->where('dist_stt.dist_code', Session::get('dist_code'))
            ->groupby('brand')
            ->get();
                
       
        // return response()->json(['results' => $data],201);
        return response()->json($data->toArray());
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

    

    

}
