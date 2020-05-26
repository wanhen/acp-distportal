@extends('layouts.app')

@section('page_title', 'Distributor Edit')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">
    
    <div class="row">
      <!-- page content -->
      
      <div class="card">
        <div class="card-header bg-green">
            <h5 class="card-title text-white"> MASTER DISTRIBUTOR </h5>
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

        <form name="frm_dist" method="post" action="{{ url('datamaster/distributorpost') }}">
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $rec_distributor->id ?? '' }}">
        <div class="row">
            <div class="col-md-6 col-lg-4">
              <div class="form-group">
                <label class="form-label">Kode</label>
                <input type="text" class="form-control" name="dist_code" id="dist_code" value="{{ $rec_distributor->dist_code ?? '' }}" placeholder="Kode" {!! ($rec_distributor->id ?? '') !== ''  ? 'readonly' : '' !!}>
              </div>
              <div class="form-group">
                <label class="form-label">Nama Distributor</label>
                <input type="text" class="form-control" name="dist_name" id="dist_name" value="{{ $rec_distributor->dist_name ?? '' }}" placeholder="Nama Distributor">
              </div>
              <div class="form-group">
                <label class="form-label">Alamat</label>
                <textarea name="address" id="address" class="form-control" cols="30" rows="6" placeholder="Alamat">{{ $rec_distributor->address ?? '' }}</textarea>                
              </div>
              <div class="form-group">
                <label class="form-label">City</label>
                <input type="text" class="form-control" name="city" id="city" value="{{ $rec_distributor->city ?? '' }}" placeholder="Kota / Kabupaten">
                
              </div>
              <div class="form-group">
                <label class="form-label">Province</label>
                <input type="text" class="form-control" name="provinsi" id="provinsi" value="{{ $rec_distributor->province ?? '' }}" placeholder="Provinsi">               
              </div>
              
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="form-group">
                <label class="form-label">Regional</label>
                <input type="text" class="form-control" name="regional" id="regional" value="{{ $rec_distributor->regional ?? '' }}" placeholder="Regional">               
              </div>
              <div class="form-group">
                <label class="form-label">Area</label>
                <input type="text" class="form-control" name="area" id="area" value="{{ $rec_distributor->area ?? '' }}" placeholder="Area">               
              </div>
              <div class="form-group">
                <label class="form-label">ASPS</label>
                <input type="text" class="form-control" name="asps" id="asps" value="{{ $rec_distributor->asps ?? '' }}" placeholder="ASPS">               
              </div>
              <div class="form-group">
                <label class="form-label">Telepon</label>
                <input type="text" class="form-control" name="phone" id="phone" value="{{ $rec_distributor->phone ?? '' }}" placeholder="Telepon">               
              </div>
              <div class="form-group">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" name="email" id="email" value="{{ $rec_distributor->email ?? '' }}" placeholder="Email">               
              </div>
              <div class="form-group">
                <label class="form-label">CP</label>
                <input type="text" class="form-control" name="pic" id="pic" value="{{ $rec_distributor->pic ?? '' }}" placeholder="PIC">               
              </div>
              <div class="form-group">
                <label class="form-label">Tgl Batas Pengiriman Laporan</label>
                <input type="date" class="form-control" name="report_date" id="report_date" value="{{ $rec_distributor->report_date ?? '' }}" placeholder="Tanggal">               
              </div>

            </div>

            <div class="col-md-6 col-lg-4">
              
              <div class="form-group">
                <label class="form-label">Apakah ada admin</label>
                <select name="is_admin_exist" id="is_admin_exist" class="form-control">
                    <option value="1" {!! ($rec_distributor->is_admin_exist ?? '') == 1 ? 'selected' : '' !!}>YA</option>
                    <option value="0" {!! ($rec_distributor->is_admin_exist ?? '') == 0 ? 'selected' : '' !!}>TIDAK</option>
                </select>              
              </div>
              <div class="form-group">
                <label class="form-label">Apakah ada IT</label>
                <select name="is_it_exist" id="is_it_exist" class="form-control">
                    <option value="1" {!! ($rec_distributor->is_it_exist ?? '') == 1 ? 'selected' : '' !!}>YA</option>
                    <option value="0" {!! ($rec_distributor->is_it_exist ?? '') == 0 ? 'selected' : '' !!}>TIDAK</option>
                </select>              
              </div>
              <div class="form-group">
                <label class="form-label">Apakah ada program yg digunakan</label>
                <select name="is_program_exist" id="is_program_exist" class="form-control">
                    <option value="1" {!! ($rec_distributor->is_program_exist ?? '') == 1 ? 'selected' : '' !!}>YA</option>
                    <option value="0" {!! ($rec_distributor->is_program_exist ?? '') == 0 ? 'selected' : '' !!}>TIDAK</option>
                </select>              
              </div>
              <div class="form-group">
                <label class="form-label">Nama Program yang digunakan</label>
                <input type="text" class="form-control" name="program_name" id="program_name" value="{{ $rec_distributor->program_name ?? '' }}" placeholder="Nama Program">               
              </div>
              <div class="form-group">
                <label class="form-label">Apakah bisa generate CSV / Excel</label>
                <select name="can_generate_csv" id="can_generate_csv" class="form-control">
                    <option value="1" {!! ($rec_distributor->can_generate_csv ?? '') == 1 ? 'selected' : '' !!}>YA</option>
                    <option value="0" {!! ($rec_distributor->can_generate_csv ?? '') == 0 ? 'selected' : '' !!}>TIDAK</option>
                </select>              
              </div>
              <div class="form-group">
                <label class="form-label">Apakah bisa Link dengan item code ACP</label>
                <select name="can_make_relation" id="can_make_relation" class="form-control">
                    <option value="1" {!! ($rec_distributor->can_make_relation ?? '') == 1 ? 'selected' : '' !!}>YA</option>
                    <option value="0" {!! ($rec_distributor->can_make_relation ?? '') == 0 ? 'selected' : '' !!}>TIDAK</option>
                </select>              
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary bg-green">Simpan</button>
                @if (($rec_distributor->id ?? '') !== '')
                  <button type="button" onclick="javascript:location.href='{{ url("/dataentry/deleteconfirm/?x=".Crypt::encryptString("id=".$rec_distributor->id."&t=acp_distributor&r=/datamaster/distributor")) }}'" class="btn btn-primary bg-red">Delete</button>
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
    <script type="text/javascript" src="{{ url('/assets/js/acp_distributorentry.js') }}"></script>
@endsection