@extends('layouts.app')

@section('page_title', 'Daftar Laporan')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">
    
    <div class="row">
      <!-- page content -->
      
      <div class="card">
        <div class="card-header bg-green">
        <h3 class="card-title text-white"> Daftar Laporan yang di upload</h3>
          <div class="card-options">
            {{-- <button type="button" class="btn btn-warning btn-sm" onclick="javascript:window.print();"><i class="si si-printer"></i> Export to Excel</button> --}}
          </div>
        </div>
        <div class="card-body">

          <!-- Begin body content -->
          <div class="table-responsive">
                <table id="mytable" class="display table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Tgl Lapor</th>
                            <th>Distributor</th>
                            <th>Nama File</th>
                            <th>Jenis Laporan</th>
                            <th>Tgl Upload</th>
                            <th>Status</th>
                        </tr>                        
                    </thead>
                    <tbody>
                        @foreach ($rec_upload as $rec)
                            <tr>
                                
                                <td>{{ $rec->report_date }}</td>
                                <td>{{ $rec->distributors->dist_name }}</td>
                                <td><a href="{{ url('uploadedfiles/'.$rec->dist_code.'/'.$rec->filename) }}"> {{ $rec->filename }}</a></td>
                                <td>{{ $rec->report_type }}</td>
                                <td>{{ $rec->created_at }}</td>
                                <td>{{ $rec->status }}</td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
          <!-- end of body content -->
                {{ $rec_upload->links() }}
              </div>
        </div>
      </div>

      <!-- end of page content -->
    </div>
  </div>
</div>
    
@endsection

@section('plugins_css')
@parent
<link href="{{ url('/') }}/themes-tabler/assets/plugins/datatables/plugin.css" rel="stylesheet" />
<link href="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.css" rel="stylesheet" />

@endsection

@section('plugins_js')
@parent
<script src="{{ url('/') }}/themes-tabler/assets/plugins/datatables/plugin.js"></script>
<script src="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.js"></script>

@endsection

@section('page_css')

@endsection

@section('page_js')
    <script type="text/javascript" src="{{ url('/assets/js/uploadlist.js') }}"></script>
@endsection