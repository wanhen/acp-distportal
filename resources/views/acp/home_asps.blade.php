@extends('layouts.app')
@section('page_title', "ACP - Distributor Portal - ASPS Page")




@section('plugins_css')
@parent
<link href="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.css" rel="stylesheet" />
<link href="{{ url('/') }}/themes-tabler/assets/plugins/bootstrap-table/plugin.css" rel="stylesheet" />
<link href="{{ url('/') }}/themes-tabler/assets/plugins/chartjs/plugin.css" rel="stylesheet" />
<link href="{{ url('/') }}/themes-tabler/assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
@endsection

@section('plugins_js')
@parent
<script src="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.js"></script>
<script src="{{ url('/') }}/themes-tabler/assets/plugins/chartjs/plugin.js"></script>
<script src="{{ url('/') }}/themes-tabler/assets/plugins/charts-c3/plugin.js"></script>
<script src="{{ url('/') }}/themes-tabler/assets/plugins/bootstrap-table/plugin.js"></script>
@endsection

@section('page_css')

@endsection

@section('page_js')
<script type="text/javascript" src="{{ url('/assets/js/home_admin.js') }}"></script>
@endsection

@section('sidebar')

@stop

@section('page_content')
@parent
<!-- show parent section, if there are any content -->
<div class="my-3 my-md-5">
    <div class="container">

        <div class="row">
            <!-- page content -->

            <div class="card">
                <div class="card-header bg-green">
                    <h3 class="card-title text-white"> Distributor Connect - ACP - ASPS</h3>
                    <div class="card-options"></div>
                </div>

                <div class="card-body">
                   
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Daftar Laporan yang sudah di Upload</h3>
                                    </div>
                                    <div class="card-body">
                                        <table id="mytable" class="table card-table table-vcenter text-nowrap">
                                            <thead>
                                                <tr>                                                    
                                                    <th>Periode</th>
                                                    <th>Jenis Laporan</th>
                                                    <th>Distributor</th>
                                                    <th>Nama File</th>
                                                    <th>Sesuai Format</th>
                                                    <th>Created</th>
                                                    <th>Status</th>                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($rec_upload as $rec)
                                                <tr>
                                                    
                                                    <td><a href="#" class="text-inherit">{{ $rec->period }}</a></td>
                                                    <td>
                                                        {{ $rec->report_type }}
                                                    </td>
                                                    <td>
                                                        {{ $rec->dist_name }}
                                                    </td>
                                                    <td><i class="fa fa-file-excel-o"></i>&nbsp;<a href="{{ url('storage/uploadedfiles/'.$rec->dist_code.'/'.$rec->filename) }}">{{ $rec->filename }}</a></td>
                                                    <td>{{ $rec->report_ok }}</td>
                                                    <td>{{ $rec->created_at }}</td>
                                                    <td>
                                                        @if ($rec->status == 'APPROVED')
                                                        <span class="status-icon bg-success"></span> {{ $rec->status }}
                                                        @else
                                                        <span class="status-icon bg-warning"></span> {{ $rec->status }}
                                                        @endif
                                                    </td>

                                                   
                                                </tr>

                                                @endforeach

                                            </tbody>
                                            
                                        </table>
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