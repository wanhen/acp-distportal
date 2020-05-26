@extends('layouts.app')

@section('page_title', 'STT Entry')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">
    
    <div class="row">
      <!-- page content -->
      
      <div class="card">
        <div class="card-header bg-green">
            <h5 class="card-title text-white"> STT ENTRY </h5>
        </div>
        <div class="card-body">

        
        <!-- Begin body content -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif  

        <form name="frm_stt" method="post" action="{{ url('dataentry/sttpost') }}">
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $rec_stt->id ?? '' }}">
        <div class="row">
            <div class="col-md-6 col-lg-4">
              <div class="form-group">
                <label class="form-label">Tanggal</label>
                <input type="date" class="form-control" name="trans_date" id="trans_date" value="{{ $rec_stt->trans_date ?? '' }}" placeholder="Tgl Transaksi">
              </div>
              <div class="form-group">
                <label class="form-label">Nomor Faktur</label>
                <input type="text" class="form-control" name="trans_no" id="trans_no" value="{{ $rec_stt->trans_no ?? '' }}" placeholder="Nomor Faktur">
              </div>
             
              <div class="form-group">
                <label class="form-label">Customer</label>
                <select name="cust_code" id="cust_code" class="form-control">
                  @foreach ($rec_customer as $item)
                    <option value="{{ $item->cust_code }}" {!! ($rec_stt->cust_code ?? '') == $item->cust_code ? 'selected' : '' !!}>{{ $item->cust_name }}</option>
                  @endforeach
                  
                </select>
              </div>
              <div class="form-group">
                <label class="form-label">Salesman</label>
                <select name="sales_code" id="sales_code" class="form-control">
                  @foreach ($rec_sales as $item)
                    <option value="{{ $item->sales_code }}" {!! ($rec_stt->sales_code ?? '') == $item->sales_code ? 'selected' : '' !!}>{{ $item->sales_name }}</option>
                  @endforeach
                  
                </select>
               
              </div>
            </div>

            <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label class="form-label">Nama Barang</label>
                <select name="item_code" id="item_code" class="form-control">
                  @foreach ($rec_item as $item)
                    <option value="{{ $item->item_code }}" {!! ($rec_stt->item_code ?? '') == $item->item_code ? 'selected' : '' !!}>{{ $item->item_name }}</option>
                  @endforeach                  
                </select>
                 <input type="hidden" name="item_name" id="item_name">
              </div>
              <div class="form-group">
                <label class="form-label">Kode SKU</label>
                <input type="text" class="form-control" name="sku_code" id="sku_code" value="{{ $rec_stt->sku_code ?? '' }}" placeholder="Kode SKU">
              </div>
              <div class="form-group">
                <label class="form-label">Batch No</label>
                <input type="text" class="form-control" name="batch_no" id="batch_no" value="{{ $rec_stt->batch_no ?? '' }}" placeholder="Batch No">
              </div>
              <div class="form-group">
                <label class="form-label">Tanggal Expired</label>
                <input type="date" class="form-control" name="expire_date" id="expire_date" value="{{ $rec_stt->expire_date ?? '' }}" placeholder="Tgl Expire">
              </div>

            </div>

            <div class="col-md-6 col-lg-4">
              
              <input type="hidden" name="uom_code" id="uom_code" value="{{ $rec_stt->uom_code ?? '' }}">
              <div class="form-group">
                <label class="form-label">Qty / Satuan</label>
                <div class="row gutters-xs">
                  <div class="col">
                    <input type="numeric" name="qty1" id="qty1" value="{{ $rec_stt->qty1 ?? '' }}" class="form-control" placeholder="0">                    
                  </div>
                  <span class="col">
                    <input type="text" name="unit1" id="unit1" value="{{ $rec_stt->unit1 ?? '' }}" class="form-control" readonly>
                  </span>
                  <div class="col">
                    <input type="numeric" name="qty2" id="qty2" value="{{ $rec_stt->qty2 ?? '' }}" class="form-control" placeholder="0">                    
                  </div>
                  <span class="col">
                    <input type="text" name="unit2" id="unit2" value="{{ $rec_stt->unit2 ?? '' }}" class="form-control" readonly>
                  </span>
                  <div class="col">
                    <input type="numeric" name="qty3" id="qty3" value="{{ $rec_stt->qty3 ?? '' }}" class="form-control" placeholder="0">                    
                  </div>
                  <span class="col">
                    <input type="text" name="unit3" id="unit3" value="{{ $rec_stt->unit3 ?? '' }}" class="form-control" readonly>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Qty Konversi ke Satuan terkecil</label>
                <div class="input-group">                  
                    <input type="number" class="form-control" name="qty" id="qty" value="{{ $rec_stt->qty ?? '' }}" placeholder="0" readonly>
                    <span class="input-group-append">
                      <input type="text" class="form-control" name="unit" id="unit" value="{{ $rec_stt->unit ?? '' }}" placeholder="Pcs" readonly>     
                    </span>
                </div>
                
              </div>
             
              <div class="form-group">
                <label class="form-label">Amount</label>
                <input type="number" class="form-control" name="amount" id="amount" value="{{ $rec_stt->amount ?? '' }}" placeholder="0">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary bg-green">Simpan</button>
                @if (($rec_stt->id ?? '') !== '')
                  <button type="button" onclick="javascript:location.href='{{ url("/dataentry/deleteconfirm/?x=".Crypt::encryptString("id=".$rec_stt->id."&t=dist_stt&r=/dataentry/sttlist")) }}'" class="btn btn-primary bg-red">Delete</button>
                @endif
              </div>
            </div>
            

          </div>
          </form>
      
          <!-- end of body content -->

        </div>
      </div>

      <!-- end of page content -->
    </div>
  </div>
</div>
    
@endsection

@section('plugins_css')
  @parent  
  <link href="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.css" rel="stylesheet" /> 
  <link href="{{ url('/') }}/themes-tabler/assets/plugins/select2-4.0.5/plugin.css" rel="stylesheet" />
    
@endsection

@section('plugins_js')
  @parent
  <script src="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.js"></script>
  <script src="{{ url('/') }}/themes-tabler/assets/plugins/select2-4.0.5/plugin.js"></script>
@endsection

@section('page_css')

@endsection

@section('page_js')
    <script type="text/javascript" src="{{ url('/assets/js/sttentry.js') }}"></script>
@endsection