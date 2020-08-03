<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DatamasterController extends Controller
{

    function index()
    {
        return 'Index';
    }

    
    public function periode(Request $request,$rec_edit=null)
    {
        $a = $request->query('a');
        if ($a == "setactive")
        {
            DB::table('acp_period')
                ->where('period', $rec_edit)
                ->update(['is_active' => 1]);
        } elseif ($a == "setinactive") {
            DB::table('acp_period')
                ->where('period', $rec_edit)
                ->update(['is_active' => 0]);
        }
        $rec_period = DB::table('acp_period')->select(DB::raw('period as bulan, period, is_active'))
            ->orderBy('period','DESC')
            ->paginate(12);       
        $data = array(
            'page_title' => 'Master Periode',
            'rec_period' => $rec_period,
            'rec_edit' => $rec_edit                    
        );
        return view('datamaster.periodelist')->with($data);
    }

    public function periode_post(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'periode' => 'required|min:7',                
            ]);
    
            // check if username exists
            $tmprec =  \App\Models\AcpPeriod::where('period', '=', $request->period)->first();
            if ($tmprec === null) {
                $data =  new \App\Models\AcpPeriod();
            } else {
                $data = $tmprec;
            }
    
           
            $data->period = $request->periode;
            $data->is_active = 1;
            $data->save();
    
           return redirect('/datamaster/periode');
        }
    }

    public function distributor(Request $request)
    {
        $rec_dist = DB::table('acp_distributor')->select(DB::raw('*'))->get();       
        $data = array(
            'page_title' => 'Master Distributor',
            'rec_dist' => $rec_dist,                    
        );
        return view('datamaster.distributorlist')->with($data);
    }

    public function distributor_edit(Request $request, $id=null)
    {
        $rec_distributor = \App\Models\AcpDistributor::where('id', $id)->first();
        $data = array(
            'page_title' => 'Distributor Edit',
            'rec_distributor' => $rec_distributor,
        );
        // dd($rec_distributor);
        return view('datamaster.distributorentry')->with($data);
    }

    public function distributor_post(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'dist_code' => 'required|min:1',
                'dist_name' => 'required',                
            ]);
    
            // check if username exists
            $tmprec =  \App\Models\AcpDistributor::where('id', '=', $request->id)->first();
            
            if ($tmprec === null) {
                $data =  new \App\Models\AcpDistributor();                
            } else {
                $data = $tmprec;               
            }
            
            $data->dist_code = ($request->dist_code ?? '');
            $data->dist_name = ($request->dist_name ?? '');
            $data->address = ($request->address ?? '');
            $data->city = ($request->city ?? '');
            $data->province = ($request->province ?? '');
            $data->regional = ($request->regional ?? '');
            $data->area = ($request->area ?? '');
            $data->asps = ($request->asps ?? '');
            $data->report_date = ($request->report_date ?? null);
            $data->phone = ($request->phone ?? '');
            $data->email = ($request->email ?? '');
            $data->pic = ($request->pic ?? '');
            $data->is_admin_exist = ($request->is_admin_exist ?? 0);
            $data->is_it_exist = ($request->is_it_exist ?? 0);
            $data->is_program_exist = ($request->is_program_exist ?? 0);
            $data->program_name = ($request->program_name ?? '');
            $data->can_generate_csv = ($request->can_generate_csv ?? 0);
            $data->can_make_relation = ($request->can_make_relation ?? 0);

            $data->save();
    
            $rec = array(                 
                'menu' => 'distributor',
                'url_back' => '/datamaster/distributor',
                'url_new' => '/datamaster/distributor',
                
            );
            return view('messages.savesuccess')->with($rec);
        }
    }

    public function distributor_salestarget_list(Request $request, $id=null)
    {
        $rec_period = DB::table('acp_period')->select(DB::raw('period as bulan, period'))->get();
        
        $selected_period = Session::get('selected_period');
        if ($selected_period == null)
        {
            Session::put('selected_period', $rec_period[0]->period);
            $selected_period = Session::get('selected_period');        
        }

        $rec_distributor = \App\Models\AcpDistributor::where('id',$id)->first();

        $period = Session::get('period');
        $rec_target = \App\Models\DistTargetItem::where('dist_code', $rec_distributor->dist_code)
            ->where('period', $period)
            ->get();

        $data = array(
            'page_title' => 'Distributor Edit',
            'rec_distributor' => $rec_distributor,
            'rec_target' => $rec_target,
            'rec_period' => $rec_period,
        );
        // dd($rec_distributor);
        return view('datamaster.distributorsalestarget')->with($data);
    }

    public function distributor_itemtarget_list(Request $request, $id=null)
    {
        $rec_period = DB::table('acp_period')->select(DB::raw('period as bulan, period'))->get();
        
        $selected_period = Session::get('selected_period');
        if ($selected_period == null)
        {
            Session::put('selected_period', $rec_period[0]->period);
            $selected_period = Session::get('selected_period');        
        }
        $rec_distributor = \App\Models\AcpDistributor::where('id',$id)->first();

        $period = Session::get('period');
        $rec_target = \App\Models\DistTargetItem::where('dist_code', $rec_distributor->dist_code)
            ->where('period', $period)
            ->get();

        $data = array(
            'page_title' => 'Distributor Target per Item',
            'rec_distributor' => $rec_distributor,
            'rec_target' => $rec_target,
            'rec_period' => $rec_period,
        );
        // dd($rec_distributor);
        return view('datamaster.distributoritemtarget')->with($data);
    }

    public function item(Request $request)
    {
        $rec_item = DB::table('acp_item')->select(DB::raw('*'))->paginate(10);       
        $data = array(
            'page_title' => 'Master Item',
            'rec_item' => $rec_item,                    
        );
        return view('datamaster.itemlist')->with($data);
    }

    public function itemmapping(Request $request)
    {
        $rec_item = DB::table('acp_item')->select(DB::raw('*'))->paginate(10);       
        $data = array(
            'page_title' => 'Distributor Item Mapping',
            'rec_item' => $rec_item,                    
        );
        return view('datamaster.itemmappinglist')->with($data);
    }

    
    // function get_new_id()
    // {
    //     $row = DB::connection('sqlsrv_sales')->table("vw_LastId")->select('LASTID')
    //     ->where('TblName', 'Doctor')
    //     ->first();

    //     $lastid = $row->LASTID+1;
    //     $lastidtext = '00000'.$lastid;
    //     $lastidtext = substr($lastidtext,-5);
    //     return 'DL'.$lastidtext;
    // }

   

    
}
