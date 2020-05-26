@extends('layouts.app')

@section('page_title', 'Customer Entry')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">
    
    <div class="row">
      <!-- page content -->
      
      <div class="card">
        <div class="card-header bg-green">
            <h5 class="card-title text-white"> CUSTOMER ENTRY </h5>
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

        <form name="frm_customer" method="post" action="{{ url('dist/customerpost') }}">
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $rec_customer->id ?? '' }}">
        <div class="row">
            <div class="col-md-6 col-lg-4">
              
              <div class="form-group">
                <label class="form-label">Kode</label>
                <input type="text" class="form-control" name="cust_code" id="cust_code" value="{{ $rec_customer->cust_code ?? '' }}" placeholder="Kode Customer" {{ ($rec_customer->cust_code ?? '' !== '' ? 'readonly' : '') }}>
              </div>
              <div class="form-group">
                <label class="form-label">Nama Customer</label>
                <input type="text" class="form-control" name="cust_name" id="cust_name" value="{{ $rec_customer->cust_name ?? '' }}" placeholder="Nama Customer">
              </div>
              <div class="form-group">
                <label class="form-label">Channel & Tipe Outlet</label>
                <select name="cust_type" id="cust_type" class="form-control">
                <option value="">-- Pilih Channel & Tipe Outlet --</option>
                <optgroup label="GENERAL TRADE">
                  <option value="GENERAL TRADE|WHS (Grosir)" {!! ($rec_customer->cust_type ?? '') == 'WHS (Grosir)' ? 'selected' : '' !!}>WHS (Grosir)</option>  
                  <option value="GENERAL TRADE|Retail" {!! ($rec_customer->cust_type ?? '') == 'Retail' ? 'selected' : '' !!}>Retail</option>  
                  <option value="GENERAL TRADE|TBK" {!! ($rec_customer->cust_type ?? '') == 'TBK' ? 'selected' : '' !!}>TBK</option>  
                </optgroup>
                <optgroup label="FOOD SERVICE">
                  <option value="FOOD SERVICE|Hotel" {!! ($rec_customer->cust_type ?? '') == 'Hotel' ? 'selected' : '' !!}>Hotel</option>  
                  <option value="FOOD SERVICE|Restoran" {!! ($rec_customer->cust_type ?? '') == 'Restoran' ? 'selected' : '' !!}>Restoran</option>  
                  <option value="FOOD SERVICE|Kafe/Kantin" {!! ($rec_customer->cust_type ?? '') == 'Kafe/Kantin' ? 'selected' : '' !!}>Kafe/Kantin</option> 
                  <option value="FOOD SERVICE|Catering" {!! ($rec_customer->cust_type ?? '') == 'Catering' ? 'selected' : '' !!}>Catering</option> 
                  <option value="FOOD SERVICE|Home Industry" {!! ($rec_customer->cust_type ?? '') == 'Home Industry' ? 'selected' : '' !!}>Home Industry</option> 
                  <option value="FOOD SERVICE|Industri" {!! ($rec_customer->cust_type ?? '') == 'Industri' ? 'selected' : '' !!}>Industry</option>
                  <option value="FOOD SERVICE|Bakery" {!! ($rec_customer->cust_type ?? '') == 'Bakery' ? 'selected' : '' !!}>Bakery</option>   
                </optgroup>    
                <optgroup label="MODERN TRADE">
                  <option value="MODERN TRADE|Mini Market" {!! ($rec_customer->cust_type ?? '') == 'Mini Market' ? 'selected' : '' !!}>Mini Market</option>  
                  <option value="MODERN TRADE|Super Market" {!! ($rec_customer->cust_type ?? '') == 'Super Market' ? 'selected' : '' !!}>Super Market</option>
                </optgroup>    
                <option value="LAINNYA|LAINNYA" {!! ($rec_customer->cust_type ?? '') == 'LAINNYA' ? 'selected' : '' !!}>LAINNYA</option>                
                </select>
               
              </div>
              
            </div>

            <div class="col-md-6 col-lg-4">
            <div class="form-group">
                <label class="form-label">Alamat</label>
                <textarea name="address" id="address" cols="30" rows="3" class="form-control" placeholder="Alamat">{{ $rec_customer->address ?? '' }}</textarea>
              </div>
              <div class="form-group">
                <label class="form-label">Kota</label>
                <input type="text" class="form-control" name="city" id="city" value="{{ $rec_customer->city ?? '' }}" placeholder="Nama Kota">
              </div>
              <div class="form-group">
                <label class="form-label">Kode Pos</label>
                <input type="text" class="form-control" name="postcode" id="postcode" value="{{ $rec_customer->postcode ?? '' }}" placeholder="Kode Pos">
              </div>
              
              <div class="form-group">
                <button type="submit" class="btn btn-primary bg-green">Simpan</button>
                @if (($rec_customer->id ?? '') !== '')
                  <button type="button" onclick="javascript:location.href='{{ url("/dataentry/deleteconfirm/?x=".Crypt::encryptString("id=".$rec_customer->id."&t=dist_customer&r=/dist/customerlist")) }}'" class="btn btn-primary bg-red">Delete</button>
                @endif
              </div>
              
            </div>

            <div class="col-md-6 col-lg-4">
            
              
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
    <script type="text/javascript" src="{{ url('/assets/js/dist_customerentry.js') }}"></script>
@endsection