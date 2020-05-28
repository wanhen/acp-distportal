@extends('layouts.app')
@section('page_title', "ACP - Distributor Portal - Admin Page")


@section('plugins_css')
  @parent  
  <link href="{{ url('/') }}/themes-tabler/assets/plugins/chartjs/plugin.css" rel="stylesheet" />
@endsection

@section('plugins_js')
  @parent
  <script src="{{ url('/') }}/themes-tabler/assets/plugins/chartjs/plugin.js"></script>
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
                  <div class="card-options"></div>
                </div>
                     
              <div class="card-body">
              
                <div class="text-wrap p-lg-6">

                  <!-- <h2 class="mt-0 mb-4">Selamat Datang di Distributor Connect - ACP - Admin</h2> -->
                  
                  <div class="row row-card row-deck">

                    <div class="col-lg-8">
                        
                        <div class="card card-aside">
                          
                            <!-- <div class="card-body d-flex flex-row">
                              <canvas id="lineChart"></canvas>
                            </div> -->
                            <div class="card-body d-flex flex-column">
                              <canvas id="barChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Penjualan per Brand</h2>
                            </div>
                            <canvas id="barChartBrand"></canvas>
                           
                        </div>
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