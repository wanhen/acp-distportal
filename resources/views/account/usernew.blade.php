@extends('layouts.app')

@section('page_title', 'User List')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">

    <div class="row">
      <!-- page content -->

      <div class="card">
        <div class="card-header bg-green">
          <h3 class="card-title text-white"> Register user baru </h3>
          <div class="card-options">
            <button type="button" class="btn btn-warning btn-sm bg-green" onclick="javascript:location.href='{{ url('/admin/user') }}';"><i class="si si-printer"></i> Lihat Daftar</button>

          </div>
        </div>
        <div class="card-body">
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          <!-- Begin body content -->
          <form name="frmnewuser" id="frmnewuser" action="{{ route('user_post') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username" id="username" class="form-control">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="form-group">
                  <label for="password">Password Confirmation</label>
                  <input type="password" name="password2" id="password2" class="form-control">
                </div>
                <!-- <div class="form-group">
                  <label for="usergroup">Group</label>
                  <input type="text" name="usergroup" id="usergroup" class="form-control">
                </div> -->
                <div class="form-group">
                  <label for="userlevel">Level</label>
                  <select name="userlevel" id="userlevel" class="form-control">
                    <option value="ACPADMIN">ACPADMIN</option>
                    <option value="DISTRIBUTOR">DISTRIBUTOR</option>
                    <option value="RSM">RSM</option>
                    <option value="ASPS">ASPS</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="dist_code">Distributor</label>
                  <select id="dist_code" name="dist_code[]" class="form-control" multiple="multiple" placeholder="Select Distributor">
                    <option value="">-- PILIH DISTRIBUTOR --</option>
                    @foreach ($rec_dist as $item)
                    <option value="{{ $item->dist_code }}">{{ $item->dist_name }} ( {{ $item->dist_code }} )</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="use_upload">Gunakan Entry utk Pelaporan</label>
                  <select name="use_upload" id="use_upload" class="form-control">
                    <option value="1">TIDAK</option>
                    <option value="0">YA</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-12"><button type="button" id="btnsubmit" class="btn btn-primary bg-green">Submit</button></div>
            </div>
          </form>
        </div>
      </div>

      <!-- end of page content -->
    </div>
  </div>
</div>

@endsection


@section('plugins_css')
@parent
<link href="{{ url('/') }}/themes-tabler/assets/plugins/select2-4.0.5/plugin.css" rel="stylesheet" />
<link href="{{ url('/') }}/themes-tabler/assets/plugins/jsgrid-1.5.3/plugin.css" rel="stylesheet" />
<link href="{{ url('/') }}/themes-tabler/assets/plugins/jquery-validation-1.17.0/plugin.css" rel="stylesheet" />
<link href="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.css" rel="stylesheet" />


@endsection

@section('plugins_js')
@parent
<script src="{{ url('/') }}/themes-tabler/assets/plugins/select2-4.0.5/plugin.js"></script>
<script src="{{ url('/') }}/themes-tabler/assets/plugins/jsgrid-1.5.3/plugin.js"></script>
<script src="{{ url('/') }}/themes-tabler/assets/plugins/jquery-validation-1.17.0/plugin.js"></script>
<script src="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.js"></script>


@endsection

@section('page_css')

@endsection

@section('page_js')
<script type="text/javascript" src="{{ url('/assets/js/usernew.js') }}"></script>
@endsection