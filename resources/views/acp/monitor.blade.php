@extends('layouts.app')

@section('page_title', 'Validasi Laporan')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">
    
    <div class="row">
      <!-- page content -->
      
      <div class="card">
        <div class="card-header bg-green">
        <h3 class="card-title text-white"> Validasi Laporan </h3>
          <div class="card-options">
            
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
                            <th>Action</th>
                        </tr>                        
                    </thead>
                    <tbody>
                        @foreach ($rec_upload as $rec)
                            <tr>
                                
                                <td>{{ $rec->report_date }}</td>
                                <td>{{ $rec->customers->cust_name }}</td>
                                <td><i class="fa fa-file-excel-o"></i>&nbsp;<a href="{{ url('uploadedfiles/'.$rec->cust_id.'/'.$rec->filename) }}"> {{ $rec->filename }}</a></td>
                                <td>{{ $rec->report_type }}</td>
                                <td>{{ $rec->created_at }}</td>
                                <td>{{ $rec->status }}</td>
                                <td>
                                @if ($rec->status == "PENDING")
                                <form action="{{ url('/admin/approve') }}" method="post">
                                {{ csrf_field() }}
                                  <input type="hidden" name="id" id="id" value="{{ $rec->id }}">
                                  <button type="submit">Approve</button>
                                </form>
                                  
                                @else 

                                @endif
                                {{-- <form action="{{ url('/admin/deletefile') }}" method="post">
                                  {{ csrf_field() }}
                                    <input type="hidden" name="id" id="id" value="{{ $rec->id }}">
                                    <button type="submit">Delete</button>
                                  </form> --}}
                                </td>
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

@endsection

@section('plugins_js')
@parent
<script src="{{ url('/') }}/themes-tabler/assets/plugins/datatables/plugin.js"></script>

@endsection

@section('page_css')

@endsection

@section('page_js')
    <script type="text/javascript" src="{{ url('/assets/js/uploadlist.js') }}"></script>
@endsection