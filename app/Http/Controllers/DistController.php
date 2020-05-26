<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class DistController extends Controller
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

    public function dist_customer_list(Request $request)
    {
        
        $rec_customer = DB::table('dist_customer')          
            ->select(DB::raw('*'))
            ->where('dist_customer.dist_code', Session::get('dist_code'))
            ->get();

        $data = array(
            'page_title' => 'Customer List',
            'rec_customer'  => $rec_customer,           
        );
        return view('dist.customerlist')->with($data);
    }
    
    public function dist_customer_entry(Request $request)
    {

        $data = array(
            'page_title' => 'Distributor Customer',
        );
        return view('dist.customerentry')->with($data);
    }

    public function dist_customer_edit(Request $request, $id)
    {       
        $rec_customer = DB::table('dist_customer')
            ->select(DB::raw('*'))
            ->where('dist_customer.dist_code', Session::get('dist_code'))
            ->where('dist_customer.id', $id)->first();
        
        $data = array(
            'page_title' => 'Customer Entry',
            'rec_customer' => $rec_customer,         
        );
        return view('dist.customerentry')->with($data);
    }

    public function dist_customer_post(Request $request)
    {
        
        if ($request->isMethod('post'))
        {
            
            $this->validate($request, [
                'cust_code' => 'required',          
                'cust_name' => 'required',                  
            ]);
    
            $data =  new \App\Models\DistCustomer();
            
            if ($request->id !== null)
            {   
                $data->exists = true; // for updating existing record
                $data->id = $request->id;
            }
            $data->cust_code = $request->cust_code;            
            $data->dist_code = Session::get('dist_code');
            $data->cust_name = $request->cust_name;
            if ($request->cust_type !== '')
            {
                $cust_type = explode("|", $request->cust_type);
                $data->channel = $cust_type[0];
                $data->cust_type = $cust_type[1];
            } else {
                $data->channel = '';
                $data->cust_type = '';
            }
            
            $data->address = $request->address;
            $data->city = $request->city;
            $data->postcode = $request->postcode;
            $data->longitude = $request->longitude;
            $data->latitude = $request->latitude;
            $data->created_by = Session::get('username');
            $data->updated_by = Session::get('username');
            $data->save();
            
            $rec = array(                 
                'menu' => 'Distributor Customer',
                'url_back' => 'dist/customerlist/',
                'url_new' => 'dist/customerentry/',
            );
            return view('messages.savesuccess')->with($rec);
        }
    }

    public function dist_salesman_list(Request $request)
    {
        
        $rec_salesman = DB::table('dist_salesman')          
            ->select(DB::raw('*'))
            ->where('dist_salesman.dist_code', Session::get('dist_code'))
            ->get();

        $data = array(
            'page_title' => 'Salesman List',               
            'rec_salesman'  => $rec_salesman,           
        );
        return view('dist.salesmanlist')->with($data);
    }
    
    public function dist_salesman_entry(Request $request)
    {

        $data = array(
            'page_title' => 'Distributor Salesman',
        );
        return view('dist.salesmanentry')->with($data);
    }

    public function dist_salesman_edit(Request $request, $id)
    {       
        $rec_salesman = DB::table('dist_salesman')
            ->select(DB::raw('*'))
            ->where('dist_salesman.dist_code', Session::get('dist_code'))
            ->where('dist_salesman.id', $id)->first();
        
        $data = array(
            'page_title' => 'Salesman Entry',
            'rec_salesman' => $rec_salesman,         
        );
        return view('dist.salesmanentry')->with($data);
    }

    public function dist_salesman_post(Request $request)
    {
        
        if ($request->isMethod('post'))
        {
            
            $this->validate($request, [
                'sales_code' => 'required',          
                'sales_name' => 'required',                  
            ]);
    
            $data =  new \App\Models\DistSalesman();
            
            if ($request->id !== null)
            {   
                $data->exists = true; // for updating existing record
                $data->id = $request->id;
            }
            $data->sales_code = $request->sales_code;            
            $data->dist_code = Session::get('dist_code');
            $data->sales_name = $request->sales_name;
            $data->created_by = Session::get('username');
            $data->updated_by = Session::get('username');
            $data->save();
            
            $rec = array(                 
                'menu' => 'Distributor Salesman',
                'url_back' => 'dist/salesmanlist/',
                'url_new' => 'dist/customerentry/',
            );
            return view('messages.savesuccess')->with($rec);
        }
    }


}
