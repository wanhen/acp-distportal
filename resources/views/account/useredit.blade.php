@extends('layouts.app')

@section('page_title', 'User Edit')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">

    <div class="row">
      <!-- page content -->

      <div class="card">
        <div class="card-header bg-green">
        <h3 class="card-title text-white"> Edit user </h3>
          <div class="card-options">
          <button type="button" class="btn btn-warning btn-sm bg-green" onclick="javascript:location.href='{{ route("user_list") }}';"><i class="si si-printer"></i> Lihat Daftar</button>

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
          <input type="hidden" name="id" id="id" value="{{ ($rec_user->id ?? '') }}">
          <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username" id="username" class="form-control" value="{{ ($rec_user->username ?? '') }}">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" class="form-control" value="{{ ($rec_user->password ?? '') }}">
                </div>
                <div class="form-group">
                  <label for="password">Password Confirmation</label>
                  <input type="password" name="password2" id="password2" class="form-control" value="{{ ($rec_user->password ?? '') }}">
                </div>
                <!-- <div class="form-group">
                  <label for="usergroup">Group</label>
                  <input type="text" name="usergroup" id="usergroup" class="form-control">
                </div> -->
                <div class="form-group">
                  <label for="userlevel">Level</label>
                  <select name="userlevel" id="userlevel" class="form-control">
                    <option value="ACPADMIN" {!! ($rec_user->userlevel ?? '') == 'ACPADMIN' ? 'selected' : '' !!}>ACPADMIN</option>
                    <option value="DISTRIBUTOR" {!! ($rec_user->userlevel ?? '') == 'DISTRIBUTOR' ? 'selected' : '' !!}>DISTRIBUTOR</option>
                    <option value="RSM" {!! ($rec_user->userlevel ?? '') == 'RSM' ? 'selected' : '' !!}>RSM</option>
                    <option value="ASPS" {!! ($rec_user->userlevel ?? '') == 'ASPS' ? 'selected' : '' !!}>ASPS</option>
                  </select>
                </div>
                <div class="form-group">
                <label for="dist_code">Distributor</label>                
                <select id="dist_code" name="dist_code[]" multiple="multiple" class="form-control" placeholder="Select Distributor">
                <option value="">-- PILIH DISTRIBUTOR --</option>
                  @foreach ($rec_dist as $item)
                        <option value="{{ $item->dist_code }}" {!! ($rec_user->dist_code ?? '') == $item->dist_code ? 'selected' : '' !!}>{{ $item->dist_name }} ( {{ $item->dist_code }} )</option>
                    @endforeach
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
