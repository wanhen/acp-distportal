@extends('layouts.app')

@section('page_title', 'Salesman Entry')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">
    
    <div class="row">
      <!-- page content -->
      
      <div class="card">
        <div class="card-header bg-green">
            <h5 class="card-title text-white"> SALESMAN ENTRY </h5>
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

        <form name="frm_salesman" method="post" action="{{ url('dist/salesmanpost') }}">
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $rec_salesman->id ?? '' }}">
        <div class="row">
            <div class="col-md-6 col-lg-4">

              
              <div class="form-group">
                <label class="form-label">Kode </label>
                <input type="text" class="form-control" name="sales_code" id="sales_code" value="{{ $rec_salesman->sales_code ?? '' }}" placeholder="Kode Salesman">
              </div>
              <div class="form-group">
                <label class="form-label">Nama Sales</label>
                <input type="text" class="form-control" name="sales_name" id="sales_name" value="{{ $rec_salesman->sales_name ?? '' }}" placeholder="Nama Salesman">
              </div>
              
              <div class="form-group">
                <button type="submit" class="btn btn-primary bg-green">Simpan</button>
                @if (($rec_salesman->id ?? '') !== '')
                  <button type="button" onclick="javascript:location.href='{{ url("/dataentry/deleteconfirm/?x=".Crypt::encryptString("id=".$rec_salesman->id."&t=dist_salesman&r=/dist/salesmanlist")) }}'" class="btn btn-primary bg-red">Delete</button>
                @endif
              </div>

            </div>

            <div class="col-md-6 col-lg-4">
           
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
    <script type="text/javascript" src="{{ url('/assets/js/dist_salesmanentry.js') }}"></script>
@endsection