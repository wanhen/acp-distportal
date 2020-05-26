<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;


class DataentryController extends Controller
{

    public function stttransentry(Request $request)
    {
        $rec_customer = \App\Models\DistCustomer::where('dist_code', Session::get('dist_code'))->get();
        $rec_sales = \App\Models\DistSalesman::where('dist_code', Session::get('dist_code'))->get();;
        $rec_item = \App\Models\AcpItem::where('brand','Dua Belibis')->orWhere('brand','Koepoe')->get();
        $rec_period = \App\Models\AcpPeriod::where('is_active', 1)
            ->orderBy('period', 'desc')
            ->get();
        $data = array(
            'page_title' => 'STT Entry',
            'rec_customer' => $rec_customer,
            'rec_sales' => $rec_sales,
            'rec_item' => $rec_item,
            'rec_period' => $rec_period,           
        );
        return view('dataentry.stttransentry')->with($data);
    }

    public function stttransedit(Request $request, $id)
    {
        $rec_customer = \App\Models\DistCustomer::where('dist_code', Session::get('dist_code'))->get();
        $rec_sales = \App\Models\DistSalesman::where('dist_code', Session::get('dist_code'))->get();;
        $rec_item = \App\Models\AcpItem::where('brand','Dua Belibis')->orWhere('brand','Koepoe')->get();
        $rec_period = \App\Models\AcpPeriod::where('is_active', 1)
            ->orderBy('period', 'desc')
            ->get();
        $rec_stttrans = DB::table('vw_dist_stt_trans')
            ->where('id', $id)->first();
        
        // dd($rec_stt);

        $data = array(
            'page_title' => 'STT Edit Entry',
            'rec_customer' => $rec_customer,
            'rec_sales' => $rec_sales,
            'rec_item' => $rec_item,  
            'rec_stttrans' => $rec_stttrans,
            'rec_period' => $rec_period,         
        );
        return view('dataentry.stttransentry')->with($data);
    }

    public function stttranspost(Request $request)
    {
        
        if ($request->isMethod('post'))
        {
            // dd($request->ditem_code);

            $this->validate($request, [
                'trans_no' => 'required|min:4',          
                'trans_date' => 'required|date',
                'cust_code' => 'required',
                'sales_code' => 'required',
            ]);
    
            $hdr = new \App\Models\DistSttHeader();
            
            if ($request->id !== null)
            {   
                $hdr->exists = true; // for updating existing record
                $hdr->id = $request->id;
                $hdr->updated_by = Session::get('username');

                // delete detail
                DB::delete('delete from dist_stt_detail where header_id = ?',[$request->id]);

                // delete stt all
                DB::delete('delete from dist_stt where header_id = ?',[$request->id]);
            }
            
            $hdr->period = Session::get('selected_period');
            $hdr->dist_code = Session::get('dist_code');
            $hdr->trans_date = $request->trans_date;
            $hdr->trans_no = $request->trans_no;
            $hdr->sales_code = $request->sales_code;
            $hdr->cust_code = $request->cust_code;
            
            $hdr->created_by = Session::get('username');
            $hdr->save();
            
            // delete detail
            $header_id = $hdr->id;
            $rcount = count($request->ditem_code);
            
            for ($i=0;$i<$rcount;$i++) {
                $dtl = new \App\Models\DistSttDetail();
                // save detail
                $dtl->header_id = $header_id;
                $dtl->item_code = $request->ditem_code[$i];
                $dtl->sku_code = ($request->ditem_code[$i] ?? '');
                // // $dtl->batch_no = $request->batch_no;
                // // $dtl->expire_date = $request->expire_date;
                $dtl->qty = ($request->dqty[$i] ?? 0);
                $dtl->unit = ($request->dunit[$i] ?? '');
                $dtl->qty1 = ($request->dqty1[$i] ?? 0);
                $dtl->unit1 = ($request->dunit1[$i] ?? '');
                $dtl->qty2 = ($request->dqty2[$i] ?? 0);
                $dtl->unit2 = ($request->dunit2[$i] ?? '');
                $dtl->discount = ($request->ddiscount[$i] ?? 0);
                $dtl->amount = ($request->damount[$i] ?? 0);
                $dtl->uom_code = ($request->duom_code[$i] ?? '');
                $dtl->created_by = Session::get('username');
                $dtl->save();


                // insert to stt 
                $stt = new \App\Models\DistStt();
                $stt->header_id = $header_id;
                $stt->period = Session::get('selected_period');
                $stt->dist_code = Session::get('dist_code');
                $stt->trans_date = $request->trans_date;
                $stt->trans_no = $request->trans_no;
                $stt->sales_code = $request->sales_code;
                $stt->cust_code = $request->cust_code;                
                
                $stt->item_code = $request->ditem_code[$i];
                $stt->sku_code = ($request->ditem_code[$i] ?? '');
                // // $stt->batch_no = $request->batch_no;
                // // $stt->expire_date = $request->expire_date;
                $stt->qty = ($request->dqty[$i] ?? 0);
                $stt->unit = ($request->dunit[$i] ?? '');
                $stt->qty1 = ($request->dqty1[$i] ?? 0);
                $stt->unit1 = ($request->dunit1[$i] ?? '');
                $stt->qty2 = ($request->dqty2[$i] ?? 0);
                $stt->unit2 = ($request->dunit2[$i] ?? '');
                $stt->discount = ($request->ddiscount[$i] ?? 0);
                $stt->amount = ($request->damount[$i] ?? 0);
                $stt->uom_code = ($request->duom_code[$i] ?? '');
                $stt->created_by = Session::get('username');
                $stt->save();
                
            }

            $rec = array(                 
                'menu' => 'STT',
                'url_back' => 'dataentry/stttranslist/',
                'url_new' => 'dataentry/stttransentry/',
            );
            return view('messages.savesuccess')->with($rec);
        }
    }

    
    public function stttranslist(Request $request)
    {
        $rec_period = DB::table('acp_period')->select(DB::raw('period as bulan, period'))
            ->where('is_active', 1)
            ->orderBy('period', 'desc')
            ->get();
        
        $selected_period = Session::get('selected_period');
        if ($selected_period == null)
        {
            Session::put('selected_period', $rec_period[0]->period);
            $selected_period = Session::get('selected_period');        
        }
       
        $rec_stttrans = DB::table('vw_dist_stt_trans')
            ->where('period', $selected_period)
            ->where('dist_code', Session::get('dist_code'))
            // ->orderBy('created_at', 'desc')
            // ->orderBy('updated_at', 'desc')
            ->get();

        

        $amount = 0;    
        $jml_rec = 0;
        $arr_customer = array();
        $arr_item = array();
        $arr_salesman = array();
        foreach ($rec_stttrans as $item)
        {
            $jml_rec = $jml_rec + 1;
            $amount = $amount + $item->amount;

            $arr_customer[] = $item->cust_code;
            $arr_item[] = $item->item_count;
            $arr_salesman[] = $item->sales_code;
        }
       
        $unique_customer = array_unique($arr_customer);
        $unique_item = 0;
        foreach ($arr_item as $citem)
        {            
            $unique_item = $unique_item + $citem;
        }
        
        $unique_salesman = array_unique($arr_salesman);
        
        // dd($rec_stt);
        $data = array(
            'page_title' => 'Stt List',
            'rec_period' => $rec_period,            
            'rec_stttrans'  => $rec_stttrans,
            'rec_stt_amount' => $amount,  
            'rec_stt_jml_rec' => $jml_rec,
            'rec_stt_arr_customer' => $unique_customer,
            'rec_stt_arr_item' => $unique_item,  
            'rec_stt_arr_salesman' => $unique_salesman,
        );
        return view('dataentry.stttranslist')->with($data);
    }

       
    public function sttentry(Request $request)
    {
        $rec_customer = \App\Models\DistCustomer::where('dist_code', Session::get('dist_code'))->get();
        $rec_sales = \App\Models\DistSalesman::where('dist_code', Session::get('dist_code'))->get();;
        $rec_item = \App\Models\AcpItem::where('brand','Dua Belibis')->orWhere('brand','Koepoe')->get();
        $rec_period = null;
        $data = array(
            'page_title' => 'STT Entry',
            'rec_customer' => $rec_customer,
            'rec_sales' => $rec_sales,
            'rec_item' => $rec_item,           
        );
        return view('dataentry.sttentry')->with($data);
    }

    public function sttedit(Request $request, $id)
    {
        $rec_customer = \App\Models\DistCustomer::where('dist_code', Session::get('dist_code'))->get();
        $rec_sales = \App\Models\DistSalesman::where('dist_code', Session::get('dist_code'))->get();;
        $rec_item = \App\Models\AcpItem::where('brand','Dua Belibis')->orWhere('brand','Koepoe')->get();
        $rec_period = null;
        $rec_stt = DB::table('dist_stt')
            ->join('acp_item', 'dist_stt.item_code', '=', 'acp_item.item_code', 'left outer')
            ->join('dist_customer', 'dist_stt.cust_code', '=', 'dist_customer.cust_code', 'left outer')            
            ->join('dist_salesman', 'dist_stt.sales_code', '=', 'dist_salesman.sales_code', 'left outer')
            ->join('acp_uom', 'dist_stt.uom_code', '=', 'acp_uom.uom_code', 'left outer')            
            ->select(DB::raw('dist_stt.id,dist_stt.trans_date,dist_stt.trans_no, dist_stt.cust_code, dist_stt.sales_code, dist_stt.item_code,dist_stt.sku_code,dist_stt.expire_date,dist_stt.batch_no,dist_stt.qty, dist_stt.unit,dist_stt.qty1, dist_stt.unit1, dist_stt.qty2, dist_stt.unit2, dist_stt.discount, dist_stt.amount, dist_stt.uom_code, dist_customer.cust_name, dist_salesman.sales_name, acp_item.item_name'))
            ->where('dist_stt.id', $id)->first();
        
        // dd($rec_stt);

        $data = array(
            'page_title' => 'STT Edit Entry',
            'rec_customer' => $rec_customer,
            'rec_sales' => $rec_sales,
            'rec_item' => $rec_item,  
            'rec_stt' => $rec_stt,         
        );
        return view('dataentry.sttentry')->with($data);
    }

    
    public function stokentry(Request $request)
    {
        $rec_item = \App\Models\AcpItem::where('brand','Dua Belibis')->orWhere('brand','Koepoe')->get();
        $rec_period = \App\Models\AcpPeriod::where('is_active', 1)
            ->orderBy('period', 'desc')
            ->get();
        $data = array(
            'page_title' => 'Stok Entry',
            'rec_item' => $rec_item, 
            'rec_period' => $rec_period,          
        );
        return view('dataentry.stokentry')->with($data);
    }

    public function stokedit(Request $request, $id)
    {
        $rec_item = \App\Models\AcpItem::where('brand','Dua Belibis')->orWhere('brand','Koepoe')->get();
        $rec_period = \App\Models\AcpPeriod::where('is_active', 1)
            ->orderBy('period', 'desc')
            ->get();
        $rec_stok = DB::table('dist_stok')
            ->join('acp_item', 'dist_stok.item_code', '=', 'acp_item.item_code', 'left outer')
            ->join('acp_uom', 'dist_stok.uom_code', '=', 'acp_uom.uom_code', 'left outer')            
            ->select(DB::raw('dist_stok.id,dist_stok.item_code,dist_stok.expire_date,dist_stok.batch_no,dist_stok.qty1, dist_stok.unit1,  dist_stok.qty2, dist_stok.unit2, dist_stok.qty, dist_stok.unit, dist_stok.uom_code, acp_item.item_name'))
            ->where('dist_stok.id', $id)->first();
        
        $data = array(
            'page_title' => 'Stok Edit Entry',
            'rec_item' => $rec_item,  
            'rec_stok' => $rec_stok,
            'rec_period' => $rec_period,         
        );
        return view('dataentry.stokentry')->with($data);
    }

    public function sttpost(Request $request)
    {
        
        if ($request->isMethod('post'))
        {
            
            $this->validate($request, [
                'trans_no' => 'required|min:4',          
                'trans_date' => 'required|date',   
                'uom_code' => 'required',
                'qty' => 'required|integer',
                'unit' => 'required',            
            ]);
    
            $data =  new \App\Models\DistStt();
            
            if ($request->id !== null)
            {   
                $data->exists = true; // for updating existing record
                $data->id = $request->id;
                $data->updated_by = Session::get('username');
            }
            
            // dd($request);

            $data->period = Session::get('selected_period');
            $data->dist_code = Session::get('dist_code');
            $data->trans_date = $request->trans_date;
            $data->trans_no = $request->trans_no;
            $data->sales_code = $request->sales_code;
            $data->cust_code = $request->cust_code;
            $data->item_code = $request->item_code;
            $data->sku_code = $request->sku_code;
            $data->batch_no = $request->batch_no;
            $data->expire_date = $request->expire_date;
            $data->qty = ($request->qty ?? 0);
            $data->unit = $request->unit;
            $data->qty1 = ($request->qty1 ?? 0);
            $data->unit1 = $request->unit1;
            $data->qty2 = ($request->qty2 ?? 0);
            $data->unit2 = $request->unit2;
            $data->qty3 = ($request->qty3 ?? 0);
            $data->unit3 = $request->unit3;
            $data->amount = ($request->amount ?? 0);
            $data->uom_code = $request->uom_code;
            $data->created_by = Session::get('username');
            // $data->created_at = \Carbon\Carbon::now();       
            $data->save();
            // return redirect('dataentry/sttlist/');
            // dd($data);
           
            $rec = array(                 
                'menu' => 'STT',
                'url_back' => 'dataentry/sttlist/',
                'url_new' => 'dataentry/sttentry/',
            );
            return view('messages.savesuccess')->with($rec);
        }
    }

    public function sttlist(Request $request)
    {
        $rec_period = \App\Models\AcpPeriod::where('is_active', 1)
            ->orderBy('period', 'desc')
            ->get();
        $selected_period = Session::get('selected_period');
        if ($selected_period == null)
        {
            Session::put('selected_period', $rec_period[0]->period);
            $selected_period = Session::get('selected_period');        
        }
       
        $rec_stt = DB::table('dist_stt')
            ->join('acp_item', 'dist_stt.item_code', '=', 'acp_item.item_code', 'left outer')
            ->join('dist_customer', 'dist_stt.cust_code', '=', 'dist_customer.cust_code', 'left outer')            
            ->join('dist_salesman', 'dist_stt.sales_code', '=', 'dist_salesman.sales_code', 'left outer')
            ->join('acp_uom', 'dist_stt.uom_code', '=', 'acp_uom.uom_code', 'left outer')            
            ->select(DB::raw('dist_stt.id,dist_stt.trans_date,dist_stt.trans_no, dist_stt.cust_code, dist_stt.sales_code, dist_stt.item_code,dist_stt.sku_code,dist_stt.expire_date,dist_stt.batch_no,dist_stt.qty, dist_stt.unit,dist_stt.qty1, dist_stt.unit1,dist_stt.qty2, dist_stt.unit2, dist_stt.discount, dist_stt.amount, dist_stt.uom_code, dist_customer.cust_name, dist_salesman.sales_name, acp_item.item_name'))
            ->where('dist_stt.period', $selected_period)
            ->where('dist_stt.dist_code', Session::get('dist_code'))
            ->orderBy('dist_stt.created_at', 'desc')
            ->orderBy('dist_stt.updated_at', 'desc')
            ->get();

        $amount = 0;    
        $jml_rec = 0;
        $arr_customer = array();
        $arr_item = array();
        $arr_salesman = array();
        foreach ($rec_stt as $item)
        {
            $jml_rec = $jml_rec + 1;
            $amount = $amount + $item->amount;

            $arr_customer[] = $item->cust_code;
            $arr_item[] = $item->item_code;
            $arr_salesman[] = $item->sales_code;
        }
       
        $unique_customer = array_unique($arr_customer);
        $unique_item = array_unique($arr_item);
        $unique_salesman = array_unique($arr_salesman);
        
        // dd($rec_stt);
        $data = array(
            'page_title' => 'Stt List',
            'rec_period' => $rec_period,            
            'rec_stt'  => $rec_stt,
            'rec_stt_amount' => $amount,  
            'rec_stt_jml_rec' => $jml_rec,
            'rec_stt_arr_customer' => $unique_customer,
            'rec_stt_arr_item' => $unique_item,  
            'rec_stt_arr_salesman' => $unique_salesman,
        );
        return view('dataentry.sttlist')->with($data);
    }

    public function stoklist(Request $request)
    {
        $rec_period = DB::table('acp_period')->select(DB::raw('period as bulan, period'))
        ->where('is_active', 1)
        ->orderBy('period', 'desc')
        ->get();

        $selected_period = Session::get('selected_period');
        if ($selected_period == null)
        {
            Session::put('selected_period', $rec_period[0]->period);
            $selected_period = Session::get('selected_period');        
        }
       
        $rec_stok = DB::table('dist_stok')
            ->join('acp_item', 'dist_stok.item_code', '=', 'acp_item.item_code', 'left outer')
            ->join('acp_uom', 'dist_stok.uom_code', '=', 'acp_uom.uom_code', 'left outer')            
            ->select(DB::raw('dist_stok.id,dist_stok.item_code,dist_stok.expire_date,dist_stok.batch_no, dist_stok.qty1, dist_stok.unit1,dist_stok.qty2, dist_stok.unit2,dist_stok.qty, dist_stok.unit, dist_stok.uom_code, acp_item.item_name'))
            ->where('dist_stok.period', $selected_period)
            ->where('dist_stok.dist_code', Session::get('dist_code'))
            ->get();
                  
        $data = array(
            'page_title' => 'Stok List',
            'rec_period' => $rec_period,            
            'rec_stok'  => $rec_stok,           
        );
        return view('dataentry.stoklist')->with($data);
    }

    public function stokpost(Request $request)
    {
        if ($request->isMethod('post'))
        {
            
            $this->validate($request, [
                'item_code' => 'required',          
                'uom_code' => 'required',
                'expire_date' => 'required|date',
                // 'qty_in' => 'required|integer',
                // 'qty_out' => 'required|integer',
                'unit' => 'required',            
            ]);

            // check if record exists
            if ($request->id == null) {
                if (\App\Models\DistStok::where('period', '=', Session::get('selected_period'))
                ->where('dist_code', '=', Session::get('dist_code'))
                ->where('item_code', '=', $request->item_code)
                ->where('expire_date', '=', $request->expire_date)
                ->exists()) 
                {
                    $msg = array (
                        'custom_message' => $request->item_name.' tgl expire :'. $request->expire_date.' sudah terdaftar, silahkan lakukan proses edit apabila di perlukan perubahan !',
                    );
                    return view("messages.custom")->with($msg);

                }
            }
           
    
            $data =  new \App\Models\DistStok();
            
            if ($request->id !== null)
            {   
                $data->exists = true; // for updating existing record
                $data->id = $request->id;
                $data->updated_by = Session::get('username');
            }
            
          
            $data->period = Session::get('selected_period');
            $data->dist_code = Session::get('dist_code');
            $data->item_code = $request->item_code;
            $data->batch_no = $request->batch_no;
            $data->expire_date = $request->expire_date;
            $data->qty1 = ($request->qty1 ?? 0);
            $data->unit1 = $request->unit1;
            $data->qty2 = ($request->qty2 ?? 0);
            $data->unit2 = $request->unit2;
            $data->qty = ($request->qty ?? 0);
            $data->unit = $request->unit;            
            $data->uom_code = $request->uom_code;
            $data->created_by = Session::get('username');  
            $data->save();
           
            $rec = array(                 
                'menu' => 'Stok',
                'url_back' => 'dataentry/stoklist/',
                'url_new' => 'dataentry/stokentry/',
            );
            return view('messages.savesuccess')->with($rec);
        }

    }

    
    public function deleteconfirm(Request $request)
    {

        $data = array(
            'x' => $request->query('x',''),
        );
        return view('messages.deleteconfirm')->with($data);
    }

    public function deletepost(Request $request)
    {
        // dd($request->x);
        // $encrypted = Crypt::encryptString('Hello world.');
        // $decrypted = Crypt::decryptString($encrypted);
        $x = Crypt::decryptString($request->x);
        parse_str($x, $x_array);
               
        $id = ($x_array['id'] ?? '');
        $t = ($x_array['t'] ?? '');
        $r = ($x_array['r'] ?? '');
        
        if ($request->isMethod('post'))
        {
           
            $field_table = $t;
            $field_key = "id";
            $field_value = $id;
            $redir_url = $r;
            
            if ($field_table !== "")
            {
                DB::connection()->delete("delete from ".$field_table." where ".$field_key." = ?",[$field_value]);
                // khusus kalo stt header
                if ($field_table == "dist_stt_header")
                {
                    DB::connection()->delete("delete from dist_stt_detail where header_id = ?",[$field_value]);
                }
                
                return redirect($redir_url);
            } else {
                return "Error Occured!";
            }
            
        }
    }

    
    
}
