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
    <script type="text/javascript" src="{{ url('/assets/js/'.$page_js) }}"></script>
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
                  
                </div>
                     
              <div class="card-body">

              

                <div class="text-wrap p-lg-6">

                  <!-- <h2 class="mt-0 mb-4">Selamat Datang di Distributor Connect - ACP - Admin</h2> -->
                  
                  <div class="row row-card row-deck">

                    <div class="col-lg-8">
                        
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Daftar File yang di Upload</h2>
                            </div>
                           
                              <!-- Begin body content -->
          <div class="table-responsive">
            <table data-toggle="table" data-height="460" data-width="600" data-search="true" data-visible-search="true" data-show-columns="true"
  data-show-footer="false">
                <thead>
                    <tr>
                        <th data-sortable="true">Tgl Lapor</th>
                        <th>Distributor</th>
                        <th data-sortable="true">Nama File</th>
                        <th>Jenis Laporan</th>
                        <th data-sortable="true">Tgl Upload</th>
                        <th>Status</th>
                    </tr>                        
                </thead>
                <tbody>
                    @foreach ($rec_upload as $rec)
                        <tr>
                            
                            <td>{{ $rec->report_date }}</td>
                            <td>{{ $rec->dist_name }}</td>
                            <td><a href="{{ url('uploadedfiles/'.$rec->dist_code.'/'.$rec->filename) }}"> {{ $rec->filename }}</a></td>
                            <td>{{ $rec->report_type }}</td>
                            <td>{{ $rec->created_at }}</td>
                            <td>{{ $rec->status }}</td>
                        </tr>
                    @endforeach
                    
                </tbody>
               
            </table>
            <!-- end of body content -->           
          </div>
                            
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Informasi</h2>
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