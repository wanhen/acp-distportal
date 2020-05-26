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
                            <!-- <table class="table card-table">
                                <tr>
                                <td>No #176677677</td>
                                <td class="text-right">
                                    <span class="badge badge-default">Rp. 769.000</span>
                                </td>
                                </tr>
                                <tr>
                                <td>No #176679887</td>
                                <td class="text-right">
                                    <span class="badge badge-success">Rp.20.000</span>
                                </td>
                                </tr>
                                <tr>
                                <td>No #986677677</td>
                                <td class="text-right">
                                    <span class="badge badge-danger">Rp.59.879.000</span>
                                </td>
                                </tr>
                                <tr>
                                <td>No #198998897</td>
                                <td class="text-right">
                                    <span class="badge badge-default">Rp.1.200.000</span>
                                </td>
                                </tr>
                                <tr>
                                <td>No #198998896</td>
                                <td class="text-right">
                                    <span class="badge badge-default">Rp.200.000</span>
                                </td>
                                </tr>
                                <tr>
                                <td>No #196798897</td>
                                <td class="text-right">
                                    <span class="badge badge-default">Rp.300.000</span>
                                </td>
                                </tr>
                            </table> -->
                        </div>
                    </div>

                    <div class="col-12">
                <!-- <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Daftar Laporan</h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">No.</th>
                          <th>Periode</th>
                          <th>Jenis Laporan</th>
                          <th>Nama File</th>
                          <th>Created</th>
                          <th>Status</th>
                          <th>Action</th>                          
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><span class="text-muted">1</span></td>
                          <td><a href="invoice.html" class="text-inherit">2019-01</a></td>
                          <td>
                            STT
                          </td>
                          <td>
                            87956621
                          </td>
                          <td>
                            15 Dec 2017
                          </td>
                          <td>
                            <span class="status-icon bg-success"></span> Success
                          </td>
                          
                          <td class="text-right">
                            <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                            <div class="dropdown">
                              <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                            </div>
                          </td>
                          
                        </tr>
                        <tr>
                          <td><span class="text-muted">1</span></td>
                          <td><a href="invoice.html" class="text-inherit">2019-01</a></td>
                          <td>
                            STT
                          </td>
                          <td>
                            87956621
                          </td>
                          <td>
                            15 Dec 2017
                          </td>
                          <td>
                            <span class="status-icon bg-warning"></span> Warning
                          </td>
                          
                          <td class="text-right">
                            <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                            <div class="dropdown">
                              <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                            </div>
                          </td>
                          
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
                </div> -->
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