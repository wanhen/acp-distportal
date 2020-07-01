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
          <div class="row">
            <div class="col-md-6">
              <div class="form-control">
                  <label for="report_type">Select Report Type</label>
                  <select name="report_type" id="report_type" class="form-control" onchange="alert(this.val())">
                    <option value="STT">STT Distributor</option>                   
                  </select>
              </div>  
            </div>
            <div class="col-md-6">

            </div>
          </div>
          
          <!-- Begin body content -->
          <div class="table-responsive">
                <table  data-toggle="table" data-height="400" data-width="600" data-search="true" data-visible-search="true" data-show-columns="true"
  data-show-footer="false">
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
                                
                                <td data-sortable="true">{{ $rec->report_date }}</td>
                                <td>{{ $rec->distributors->dist_name }}</td>
                                <td><i class="fa fa-file-excel-o"></i>&nbsp;<a href="{{ url('uploadedfiles/'.$rec->dist_code.'/'.$rec->filename) }}"> {{ $rec->filename }}</a></td>
                                <td>{{ $rec->report_type }}</td>
                                <td data-sortable="true">{{ $rec->created_at }}</td>
                                <td>{{ $rec->status }}</td>
                                <td>
                                @if ($rec->status == "PENDING")
                                  <!-- <a href="{{ route('validate_stt', ['id' => $rec->id]) }}" class="btn btn-primary bg-green"><i class="fe fe-check-circle"></i>&nbsp; Validate</a> -->
                                  <a href="{{ route('validate_stt_approve_manual_confirm', ['x' => Crypt::encryptString("id=".$rec->id."&t=upload_file&r=/validate/list")]) }}" class="btn btn-primary bg-green"><i class="fe fe-check-circle"></i>&nbsp; Validate</a>
                                  <!-- x=".Crypt::encryptString("id=".$rec_stok->id."&t=dist_stok&r=/dataentry/stoklist" -->
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
                   
                </table>
          <!-- end of body content -->
            
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
<link href="{{ url('/') }}/themes-tabler/assets/plugins/bootstrap-table/plugin.css" rel="stylesheet" />
<link href="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.css" rel="stylesheet" />


@endsection

@section('plugins_js')
@parent
<script src="{{ url('/') }}/themes-tabler/assets/plugins/bootstrap-table/plugin.js"></script>
<script src="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.js"></script>

@endsection

@section('page_css')

@endsection

@section('page_js')
    <script type="text/javascript" src="{{ url('/assets/js/validasiuploadlist.js') }}"></script>
@endsection