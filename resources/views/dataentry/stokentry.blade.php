@extends('layouts.app')

@section('page_title', 'STOK Entry')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">
    
    <div class="row">
      <!-- page content -->
      
      <div class="card">
        <div class="card-header bg-green">
            <h5 class="card-title text-white"> STOK ENTRY </h5>
            <div class="card-options">
                <select name="period" id="period" class="form-control">
                  <option value="">-- Pilih Periode --</option>
                  @foreach ($rec_period as $item)
                      <option value="{{ $item->period }}" @if ( Session::get("selected_period") == $item->period) selected="selected" @endif>{{ $item->period }}</option>
                  @endforeach
                </select>
            </div>
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

        <form name="frm_stok" method="post" action="{{ url('dataentry/stokpost') }}">
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $rec_stok->id ?? '' }}">
        <div class="row">
            <div class="col-md-6 col-lg-6">

              <div class="form-group">
                <label class="form-label">Nama Barang</label>
                <select name="item_code" id="item_code" class="form-control">
                  @foreach ($rec_item as $item)
                    <option value="{{ $item->item_code }}" {!! ($rec_stok->item_code ?? '') == $item->item_code ? 'selected' : '' !!}>{{ $item->item_name }}</option>
                  @endforeach                  
                </select>
                <input type="hidden" name="item_name" id="item_name">
              </div>
              <div class="form-group">
                <label class="form-label">Kode SKU</label>
                <input type="text" class="form-control" name="sku_code" id="sku_code" value="{{ $rec_stok->item_code ?? '' }}" placeholder="Kode SKU" readonly>
              </div>
              <div class="form-group">
                <label class="form-label">Tanggal Expired</label>
                <input type="date" class="form-control" name="expire_date" id="expire_date" value="{{ $rec_stok->expire_date ?? '' }}" placeholder="Tgl Expire">
              </div>
              <div class="form-group">
                <label class="form-label">Batch No</label>
                <input type="text" class="form-control" name="batch_no" id="batch_no" value="{{ $rec_stok->batch_no ?? '' }}" placeholder="Batch No">
              </div>
              
            </div>

            <div class="col-md-6 col-lg-6">
            
              <div class="form-group">
                <label class="form-label">Qty / Satuan</label>
                <div class="row gutters-xs">
                  <div class="col">
                    <input type="numeric" name="qty1" id="qty1" value="{{ $rec_stok->qty1 ?? '' }}" class="form-control" placeholder="0">                    
                  </div>
                  <span class="col">
                    <input type="text" name="unit1" id="unit1" value="{{ $rec_stok->unit1 ?? '' }}" class="form-control" readonly>
                  </span>
                  <div class="col">
                    <input type="numeric" name="qty2" id="qty2" value="{{ $rec_stok->qty2 ?? '' }}" class="form-control" placeholder="0">                    
                  </div>
                  <span class="col">
                    <input type="text" name="unit2" id="unit2" value="{{ $rec_stok->unit2 ?? '' }}" class="form-control" readonly>
                  </span>
                  
                </div>
              </div>
              
              <div class="form-group">
                <input type="hidden" name="uom_code" id="uom_code" value="{{ $rec_stok->uom_code ?? '' }}">
                <label class="form-label">Qty / Satuan Terkecil</label>
                <div class="input-group">                  
                    <input type="number" class="form-control" name="qty" id="qty" value="{{ $rec_stok->qty ?? '' }}" placeholder="0" readonly>
                    <span class="input-group-append">
                      <input type="text" class="form-control" name="unit" id="unit" value="{{ $rec_stok->unit ?? '' }}" readonly>     
                    </span>
                </div>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary bg-green">Simpan</button>
                @if (($rec_stok->id ?? '') !== '')
                  <button type="button" onclick="javascript:location.href='{{ url("/dataentry/deleteconfirm/?x=".Crypt::encryptString("id=".$rec_stok->id."&t=dist_stok&r=/dataentry/stoklist")) }}'" class="btn btn-primary bg-red">Delete</button>
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
    <script type="text/javascript" src="{{ url('/assets/js/stokentry.js') }}"></script>
@endsection