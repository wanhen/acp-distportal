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

        <form name="frm_stt" method="post" action="{{ url('dataentry/stttranspost') }}">
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $rec_stttrans->id ?? '' }}">
        <div class="row">
            <div class="col-md-6 col-lg-6">
              <div class="form-group">
                <label class="form-label">Tanggal</label>
                <input type="date" class="form-control" name="trans_date" id="trans_date" value="{{ $rec_stttrans->trans_date ?? '' }}" placeholder="Tgl Transaksi">
              </div>
              <div class="form-group">
                <label class="form-label">Nomor Faktur</label>
                <input type="text" class="form-control" name="trans_no" id="trans_no" value="{{ $rec_stttrans->trans_no ?? '' }}" placeholder="Nomor Faktur">
              </div>
            </div>
            <div class="col-md-6 col-lg-6"> 
              <div class="form-group">
                <label class="form-label">Customer</label>
                <select name="cust_code" id="cust_code" class="form-control">
                  @foreach ($rec_customer as $item)
                    <option value="{{ $item->cust_code }}" {!! ($rec_stttrans->cust_code ?? '') == $item->cust_code ? 'selected' : '' !!}>{{ $item->cust_name }}</option>
                  @endforeach
                  
                </select>
              </div>
              <div class="form-group">
                <label class="form-label">Salesman</label>
                <select name="sales_code" id="sales_code" class="form-control">
                  @foreach ($rec_sales as $item)
                    <option value="{{ $item->sales_code }}" {!! ($rec_stttrans->sales_code ?? '') == $item->sales_code ? 'selected' : '' !!}>{{ $item->sales_name }}</option>
                  @endforeach
                  
                </select>
               
              </div>
            </div>
        </div>

        <div class="table-responsive">
        <table class="table table-dark table-sm">
          <thead>
            <tr>
              <td>Nama Barang</td>
              <td>Qty1</td>
              <td>Satuan1</td>
              <td>Qty2</td>
              <td>Satuan2</td>
              <td>Discount</td>
              <td>Amount</td>
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td width="40%">
                <select name="item_code" id="item_code" class="form-control">
                  <option value="">--- Pilih Produk ---</option>  
                  @foreach ($rec_item as $item)
                      <option value="{{ $item->item_code }}">{{ $item->item_name }}</option>
                    @endforeach                  
                  </select>
                  <input type="hidden" name="sku_code" id="sku_code">
                  <input type="hidden" name="item_name" id="item_name">
              </td>
              <td width="5%">
                <input type="hidden" name="uom_code" id="uom_code">
                <input type="hidden" name="qty" id="qty" placeholder="0">
                <input type="hidden" name="unit" id="unit" placeholder="Pcs"> 
                <input type="numeric" name="qty1" id="qty1" class="form-control" placeholder="0">  
              </td>
              <td width="5%">
                <input type="text" name="unit1" id="unit1" class="form-control" readonly>
              </td>
              <td width="5%">
                <input type="numeric" name="qty2" id="qty2" class="form-control" placeholder="0">     
              </td>
              <td width="5%">
                <input type="text" name="unit2" id="unit2" class="form-control" readonly>
              </td>
              <td>
                <input type="number" class="form-control text-right" name="discount" id="discount" placeholder="0">   
              </td>
              <td>
                <input type="number" class="form-control text-right" name="amount" id="amount" placeholder="0">
              </td>
              <td>
                <button type="button" class="btn btn-primary bg-green" onclick="addHandle()"><i class='fe fe-check-circle'></i></button>                
              </td>
            </tr>
          </tbody>
        </table>
        </div>
        


          <div class="table-responsive">
            
            <table class="table table-light table-hover table-sm" id="tbl_detail">
            <thead>
              <tr>
              <td style="display:none;">id</td>
              <td width="40%">Nama Barang</td>
              <td style="display:none;">Kode Barang</td>
              <td width="5%">Qty1</td>
              <td width="5%">Satuan1</td>
              <td width="5%">Qty2</td>
              <td width="5%">Satuan2</td>
              <td style="display:none;">Qty Terkecil</td>
              <td style="display:none;">Satun Terkecil</td>
              <td width="18%">Discount</td>
              <td width="18%">Amount</td>
              <td width="4%">Action</td>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
            <tfoot>
              <tr class="table-dark">
                <td style="display:none;"></td>
                <td width="40%">TOTAL</td>
                <td style="display:none;"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td width="5%"></td>
                <td style="display:none;"></td>
                <td style="display:none;"></td>
                <td width="18%" class="text-right"><span id="total_discount">0</span></td>
                <td width="18%" class="text-right"><span id="total_amount">0</span></td>
                <td width="4%"></td>
              </tr>
            </tfoot>
            </table>
          </div>
          <div class="row">
            <div class="form-group">
                <button type="submit" class="btn btn-primary bg-green">Simpan</button>
                @if (($rec_stttrans->id ?? '') !== '')
                  <button type="button" onclick="javascript:location.href='{{ url("/dataentry/deleteconfirm/?x=".Crypt::encryptString("id=".$rec_stttrans->id."&t=dist_stt_header&r=/dataentry/stttranslist")) }}'" class="btn btn-primary bg-red">Delete</button>
                @endif
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
    <script type="text/javascript" src="{{ url('/assets/js/stttransentry.js') }}"></script>
@endsection