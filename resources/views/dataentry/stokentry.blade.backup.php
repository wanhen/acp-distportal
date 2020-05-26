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
            <div class="col-md-6 col-lg-4">

              <div class="form-group">
                <label class="form-label">Nama Barang</label>
                <select name="item_code" id="item_code" class="form-control">
                  @foreach ($rec_item as $item)
                    <option value="{{ $item->item_code }}" {!! ($rec_stok->item_code ?? '') == $item->item_code ? 'selected' : '' !!}>{{ $item->item_name }}</option>
                  @endforeach                  
                </select>
              </div>
              <div class="form-group">
                <label class="form-label">Kode SKU</label>
                <input type="text" class="form-control" name="sku_code" id="sku_code" value="{{ $rec_stok->item_code ?? '' }}" placeholder="Kode SKU" readonly>
              </div>
              <div class="form-group">
                <label class="form-label">Batch No</label>
                <input type="text" class="form-control" name="batch_no" id="batch_no" value="{{ $rec_stok->batch_no ?? '' }}" placeholder="Batch No">
              </div>
              <div class="form-group">
                <label class="form-label">Tanggal Expired</label>
                <input type="date" class="form-control" name="expire_date" id="expire_date" value="{{ $rec_stok->expire_date ?? '' }}" placeholder="Tgl Expire">
              </div>

            </div>

            <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label class="form-label">Satuan</label>
                <input type="text" class="form-control" name="unit" id="unit" value="{{ $rec_stok->unit ?? '' }}" placeholder="Pcs" readonly>
                <input type="hidden" name="uom_code" id="uom_code" value="{{ $rec_stok->uom_code ?? '' }}">
              </div>
              <div class="form-group">
                <label class="form-label">Qty OB</label>
                <input type="number" class="form-control" name="qty_ob" id="qty_ob" value="{{ $rec_stok->qty_ob ?? '' }}" placeholder="0">
              </div>
              <div class="form-group">
                <label class="form-label">Qty IN</label>
                <input type="number" class="form-control" name="qty_in" id="qty_in" value="{{ $rec_stok->qty_in ?? '' }}" placeholder="0">
              </div>
              <div class="form-group">
                <label class="form-label">Qty OUT</label>
                <input type="number" class="form-control" name="qty_out" id="qty_out" value="{{ $rec_stok->qty_out ?? '' }}" placeholder="0">
              </div>
              
            </div>

            <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label class="form-label">Qty BS</label>
                <input type="number" class="form-control" name="qty_bs" id="qty_bs" value="{{ $rec_stok->qty_bs ?? '' }}" placeholder="0">
              </div>
              <div class="form-group">
                <label class="form-label">Qty < 1 Tahun</label>
                <input type="number" class="form-control" name="qty_oneyear" id="qty_oneyear" value="{{ $rec_stok->qty_oneyear ?? '' }}" placeholder="0">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary bg-green">Simpan</button>
                @if (($rec_stok->id ?? '') !== '')
                  <button type="button" onclick="javascript:location.href='{{ url("/dataentry/deleteconfirm/?id=".$rec_stok->id."&t=stok&r=/dataentry/stoklist") }}'" class="btn btn-primary bg-red">Delete</button>
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