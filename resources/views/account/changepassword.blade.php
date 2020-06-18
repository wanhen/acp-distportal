@extends('layouts.app')

@section('page_title', 'Ubah Password')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">
    
    <div class="row">
      <!-- page content -->
      
      <div class="card">
        <div class="card-header bg-green">
            <h5 class="card-title text-white"> CHANGE PASSWORD </h5>
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

        @if ($message = Session::get('success'))
          <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert"></button>
            <strong>{{ $message }}</strong>
          </div>
        @endif

        <form action="{{ url('changepassword_post') }}" method="post">
          {{ csrf_field() }}

          <div class="form-group">
            <label for="password_old">Password Lama</label>
            <input type="password" name="password_old" id="password_old" class="form-control" placeholder="Password Lama">            
          </div>
          <div class="form-group">
            <label for="password_new">Password Baru</label>
            <input type="password" name="password_new" id="password_new" class="form-control" placeholder="Password Baru">            
          </div>
          <div class="form-group">
            <label for="password">Password Baru ( Ulangi )</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password Baru">            
          </div>

          <div class="form-group">
          <button type="submit" class="btn btn-primary bg-green">Ubah Password</button>
          </div>

          <!-- <div class="form-group">
            <label for="email">Masukan alamat email anda</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="email">
            <button type="submit" class="btn btn-primary bg-green">Request Password</button>
          </div> -->
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

@endsection

@section('plugins_js')
  @parent
  <script src="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.js"></script>
@endsection

@section('page_css')

@endsection

@section('page_js')
    <script type="text/javascript" src="{{ url('/assets/js/monitor.js') }}"></script>
@endsection