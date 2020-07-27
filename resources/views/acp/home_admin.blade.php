@extends('layouts.app')
@section('page_title', "ACP - Distributor Portal - Admin Page")




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
{!! $chart->script() !!}
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
                    <h3 class="card-title text-white"> Distributor Connect - ACP - ADMIN</h3>
                    <div class="card-options"></div>
                </div>

                <div class="card-body">
                    <div class="text-wrap p-lg-6">

                        <h2 class="mt-0 mb-4">Selamat Datang di Distributor Portal - ACP - Admin</h2>

                        <div class="row row-card row-deck">

                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Pengiriman Laporan Terbaru</h3>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table card-table table-vcenter text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="w-1">No.</th>
                                                    <th>Periode</th>
                                                    <th>Jenis Laporan</th>
                                                    <th>Distributor</th>
                                                    <th>Nama File</th>
                                                    <th>Sesuai Format</th>
                                                    <th>Created</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($rec_upload as $rec)
                                                <tr>
                                                    <td><span class="text-muted">{{ $rec_upload->firstItem() + ($loop->iteration-1) }}</span></td>
                                                    <td><a href="#" class="text-inherit">{{ $rec->period }}</a></td>
                                                    <td>
                                                        {{ $rec->report_type }}
                                                    </td>
                                                    <td>
                                                        {{ $rec->dist_name }}
                                                    </td>
                                                    <td>{{ $rec->filename }}</td>
                                                    <td>{{ $rec->report_ok }}</td>
                                                    <td>{{ $rec->created_at }}</td>
                                                    <td>
                                                        @if ($rec->status == 'SUCCESS')
                                                        <span class="status-icon bg-success"></span> {{ $rec->status }}
                                                        @else
                                                        <span class="status-icon bg-warning"></span> {{ $rec->status }}
                                                        @endif
                                                    </td>

                                                    <td class="text-right">

                                                        <div class="dropdown">
                                                            <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="#"><i class="fe fe-maximize"></i>&nbsp;View</a>
                                                                <a class="dropdown-item" href="{{ route('validate_stt', ['id' => $rec->id]) }}"><i class="fe fe-check-circle"></i>&nbsp;Validate</a>

                                                            </div>
                                                        </div>

                                                    </td>

                                                </tr>

                                                @endforeach

                                            </tbody>
                                            <tr>
                                                <td colspan="9">{{ $rec_upload->links() }}</td>
                                            </tr>
                                        </table>
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