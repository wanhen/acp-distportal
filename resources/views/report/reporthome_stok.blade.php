@extends('layouts.app')

@section('page_title', 'Admin Report - STOK')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">
    
    <div class="row">
      <!-- page content -->
      
      <div class="card">
        <div class="card-header bg-green">
            <h5 class="card-title text-white"> Laporan Admin - Stok Distributor</h5>
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

        <div class="row">
            <div class="col-lg-4 col-md-4">
              @include('laporan.reporthome_menu')
            </div> 
            <div class="col-lg-8 col-md-8">
              <div class="form-group">
                <label class="col-md-12 control-label" for="hospital_id">Distributor</label>
                <div class="col-md-12">
                  <select id="dist_code" name="dist_code" class="form-control" placeholder="Select Distributor">
                    @foreach ($rec_dist as $item)
                          <option value="{{ $item->dist_code }}">{{ $item->dist_name }} ( {{ $item->dist_code }} )</option>
                      @endforeach
                  </select>                  
                </div>
              </div>
              
              
                
                <div class="form-group">
                    <label class="col-md-12 control-label" for="bulan">Tanggal Laporan</label>  
                    <div class="col-md-12">
                      <div class="input-group">
                        <span class="input-group-prepend">
                          <span class="input-group-text">Pilih</span>
                        </span>
                        <select id="doctor_id" class="form-control" name="tanggal">
                            @foreach ($rec_tanggal as $item)
                                <option value="{{ $item->tanggal }}">{{ $item->tanggal }}</option>
                            @endforeach
                        </select>
                        
                      </div>
                    </div>
                  </div>
                
                  <div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
            
            </div>
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
    <script type="text/javascript" src="{{ url('/assets/js/reporthome_stok.js') }}"></script>
@endsection