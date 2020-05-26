@extends('layouts.app')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">
    
    <div class="row">
      <!-- page content -->
      
      <div class="card">
        <div class="card-header bg-blue">
        <h3 class="card-title text-white"><i class="fa fa-bank"></i> Data hasil upload </h3>
          <div class="card-options">
            <button type="button" class="btn btn-warning btn-sm" onclick="javascript:window.print();"><i class="si si-printer"></i> Export to Excel</button>
          </div>
        </div>
        <div class="card-body">

          <!-- Begin body content -->
                <table id="mytable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Hospital Name</th>
                            <th>City</th>
                            <th>Province</th>
                        </tr>                        
                    </thead>
                    <tbody>
                        @foreach ($hospitals as $hospital)
                            <tr>
                                <td>{{ $hospital->HospitalId }}</td>
                                <td>{{ $hospital->HospitalName }}</td>
                                <td>{{ $hospital->City }}</td>
                                <td>{{ $hospital->Province }}</td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
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
<link href="{{ url('/') }}/themes-tabler/assets/plugins/datatables/plugin.css" rel="stylesheet" />

@endsection

@section('plugins_js')
@parent
<script src="{{ url('/') }}/themes-tabler/assets/plugins/datatables/plugin.js"></script>

@endsection

@section('page_css')

@endsection

@section('page_js')
    <script type="text/javascript" src="{{ url('/assets/js/nopage.js') }}"></script>
@endsection