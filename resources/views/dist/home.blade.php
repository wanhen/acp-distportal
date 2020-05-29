@extends('layouts.app')
@section('page_title', "ACP - Distributor Portal - Admin Page")


@section('plugins_css')
  @parent  
  <link href="{{ url('/') }}/themes-tabler/assets/plugins/bootstrap-table/plugin.css" rel="stylesheet" />
  <link href="{{ url('/') }}/themes-tabler/assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
  <link href="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.css" rel="stylesheet" />
@endsection

@section('plugins_js')
  @parent
  <script src="{{ url('/') }}/themes-tabler/assets/plugins/bootstrap-table/plugin.js"></script>
  <script src="{{ url('/') }}/themes-tabler/assets/plugins/charts-c3/plugin.js"></script>
  <script src="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.js"></script>

@endsection

@section('page_css')

@endsection

@section('page_js')    
    <script type="text/javascript" src="{{ url('/assets/js/home_distributor.js') }}"></script>
@endsection

@section('sidebar')

@stop

@section('page_content')
@parent <!-- show parent section, if there are any content -->
    <div class="my-3 my-md-5">
        <div class="container">
          
          <div class="row">
            <!-- page content -->
            
            <div class="card">
                <div class="card-header bg-green">
                  <h3 class="card-title text-white"> Distributor Connect - ACP</h3>
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

              

                <div class="text-wrap p-lg-6">

                  <!-- <h2 class="mt-0 mb-4">Selamat Datang di Distributor Connect - ACP - Admin</h2> -->
                  
                  <div class="row row-card row-deck">

                    <div class="col-lg-8">
                        
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Penjualan by Channel</h2>
                            </div>
                           
                              <div id="bar-chart-sales-by-channel"></div>
                            
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Penjualan by Brand</h2>
                            </div>                            
                            <div id="pie-chart-sales-by-brand"></div>
                            <!-- <div id="chart-pie" style="height: 12rem;"></div> -->
                            
                        </div>
                    </div>

                   

                  </div>
                  
                </div>
              </div>
            </div>

           
      
            <!-- end of page content -->
          </div>
        </div>
      </div>
@stop