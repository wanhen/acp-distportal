@extends('layouts.app')

@section('page_title', 'Admin Report - DISTRIBUTOR')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">
    
    <div class="row">
      <!-- page content -->
      
      <div class="card">
        <div class="card-header bg-green">
            <h5 class="card-title text-white"> Laporan Admin - Daftar Distributor</h5>
        </div>
        <div class="card-body">

        
        <!-- Begin body content -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif  

        <div class="row">
            <div class="col-lg-4 col-md-4">
              @include('report.reporthome_menu')
            </div> 
            <div class="col-lg-8 col-md-8">
            
              <table class="table table-light">
                <thead>
                    <tr>
                        <td>Code</td>
                        <td>Nama Distributor</td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($rec_dist as $row)
                    <tr>
                        <td>{{ $row->dist_code }}</td>
                        <td>{{ $row->dist_name }}</td>
                    </tr>
                @endforeach
                </tbody>
              </table>

              {{ $rec_dist->links() }}
 
            </div>
          </div>  
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
  <link href="{{ url('/') }}/themes-tabler/assets/plugins/select2-4.0.5/plugin.css" rel="stylesheet" />
  <link href="{{ url('/') }}/themes-tabler/assets/plugins/jsgrid-1.5.3/plugin.css" rel="stylesheet" />
  <link href="{{ url('/') }}/themes-tabler/assets/plugins/jquery-validation-1.17.0/plugin.css" rel="stylesheet" />
  <link href="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.css" rel="stylesheet" />

  
@endsection

@section('plugins_js')
  @parent
  <script src="{{ url('/') }}/themes-tabler/assets/plugins/select2-4.0.5/plugin.js"></script>
  <script src="{{ url('/') }}/themes-tabler/assets/plugins/jsgrid-1.5.3/plugin.js"></script>
  <script src="{{ url('/') }}/themes-tabler/assets/plugins/jquery-validation-1.17.0/plugin.js"></script>
  <script src="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.js"></script>
  
@endsection

@section('page_css')

@endsection

@section('page_js')
    <script type="text/javascript" src="{{ url('/assets/js/reporthome_stok.js') }}"></script>
@endsection