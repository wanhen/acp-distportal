@extends('layouts.app')

@section('page_title', 'Upload Laporan - Sale In')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">

    <div class="row">
      <!-- page content -->

      <div class="card">
        <div class="card-header bg-green">
        <h5 class="card-title text-white"> FILE UPLOAD - SALE IN ( DATA ANALYST ONLY )</h5>
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

          <form action="{{ route('upload_std') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                  <label class="col-md-12 control-label" for="period">Bulan</label>
                  <div class="col-md-12">
                    
                      <select id="period" class="form-control" name="period">
                        @foreach ($rec_period as $item)
                            <option value="{{ $item->bulan }}">{{ $item->bulan }}</option>
                        @endforeach
                      </select>
                      <i class="text-warning">
                        data yang di upload akan mengganti data lama sesuai periode yang di pilih.Pastikan memilih periode yang sesuai dengan file yang di upload.
                      </i>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-12 control-label" for="report_type">Pilih file yang akan diupload</label>
                  <div class="col-md-12">
                    <input type="file" name="uploaded_file" class="form-control">
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
