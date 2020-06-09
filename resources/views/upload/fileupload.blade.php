@extends('layouts.app')

@section('page_title', 'Upload Laporan')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">

    <div class="row">
      <!-- page content -->

      <div class="card">
        <div class="card-header bg-green">
        <h5 class="card-title text-white"> FILE UPLOAD </h5>
          <div class="card-options">
            &nbsp;
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

        @if ($message = Session::get('error'))
          <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert"></button>
            <h3>{!! $message !!}</h3>
          </div>
        @endif

        @if ($message = Session::get('error-validation'))
          <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert"></button>
            <strong>{!! $message !!}</strong>
          </div>
        @endif

        @if ($message = Session::get('upload-success'))
          <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert"></button>
            <strong>{{ $message }}</strong>
          </div>
        @endif


        <div class="row">
          <div class="col-md-12">

          <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label class="col-md-12 control-label" for="cust_name">Distributor</label>
                  <div class="col-md-12">
                    <input type="hidden" name="dist_code" value="{{ Session::get('dist_code') }}">
                    <input type="text" id="dist_name" name="dist_name" placeholder="Nama Distributor" value="{{ Session::get('dist_name') }}" class="form-control" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-12 control-label" for="report_type">Jenis Laporan</label>
                  <div class="col-md-12">
                    <select id="report_type" name="report_type" placeholder="Pilih Jenis Laporan" class="form-control">
                      <option value="STT">Laporan STT</option>                      
                    </select>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 control-label" for="report_ok">Apakah Laporan sudah sesuai dengan format dari ACP</label>
                    <div class="col-md-12">
                      <select id="report_ok" name="report_ok" class="form-control">
                        <option value="TIDAK">TIDAK</option>
                        <option value="YA">YA</option>
                      </select>
                    </div>
                  </div>

                <div class="form-group">
                  <label class="col-md-12 control-label" for="bulan">Bulan</label>
                  <div class="col-md-12">
                    <div class="input-group">
                        <select id="bulan" class="form-control" name="bulan">
                          @foreach ($rec_period as $item)
                              <option value="{{ $item->bulan }}">{{ $item->bulan }}</option>
                          @endforeach
                        </select>
                    </div>
                  </div>
                </div>

                <input type="hidden" name="date_report" id="date_report" value="{{  now()->toDateString('Y-m-d') }}">
                <!-- <div class="form-group">
                  <label class="col-md-12 control-label" for="date_report">Tgl Laporan</label>
                  <div class="col-md-12">
                    <div class="input-group">
                      <input type="text" id="date_report" name="date_report" placeholder="Tanggal Laporan" class="form-control datepicker" value="{{  now()->toDateString('Y-m-d') }}" autocomplete="off" readonly>
                      <div class="input-group-append">
                        <span class="input-group-text" id="my-addon"><i class="fe fe-calendar"></i></span>
                      </div>
                    </div>
                  </div>
                </div> -->

                <div class="form-group">
                  <label class="col-md-12 control-label" for="report_type">Pilih file yang akan diupload</label>
                  <div class="col-md-12">
                    <input type="file" name="uploaded_file"  accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" class="form-control">
                  </div>
                </div>


                <br>
                <button class="btn btn-success">Submit File</button>

            </form>

          </div>

        </div>

        <div>
            &nbsp;
        </div>


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

@endsection

@section('plugins_js')
  @parent
  <script src="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.js"></script>
@endsection

@section('page_css')

@endsection

@section('page_js')
    <script type="text/javascript" src="{{ url('/assets/js/uploadfile.js') }}"></script>
@endsection
