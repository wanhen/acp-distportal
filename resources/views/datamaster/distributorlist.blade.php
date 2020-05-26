@extends('layouts.app')

@section('page_title', 'Daftar Periode')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">
    
    <div class="row">
      <!-- page content -->
      
      <div class="card">
        <div class="card-header bg-green">
            <h5 class="card-title text-white"> DAFTAR DISTRIBUTOR </h5>
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
        <div class="col-lg-12 col-md-12 responsive">
            <table class="table table-bordered" id="mytable">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Code</td>
                        <td>Nama Distributor</td>
                        <td>Regional</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($rec_dist as $row)
                    <!-- {{ $loop->iteration }} -->
                    <tr>
                        <td>{{ $loop->iteration }} </td>
                        <td>{{ $row->dist_code }}</td>
                        <td>{{ $row->dist_name }}</td>
                        <td>{{ $row->regional }}</td>
                        <td>
                        <div class="dropdown">
                              <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ url('/datamaster/distributoredit/'.$row->id) }}"><i class="fe fe-edit"></i>&nbsp; Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('/datamaster/distributorsalestarget/'.$row->id) }}"><i class="fe fe-credit-card"></i>&nbsp; Sales Target</a>                                
                                <a class="dropdown-item" href="{{ url('/datamaster/distributoritemtarget/'.$row->id) }}"><i class="fe fe-flag"></i>&nbsp;Target per Item</a>
                              </div>
                            </div>
                                              
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

           
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
  <link href="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.css" rel="stylesheet" />
  <link href="{{ url('/') }}/themes-tabler/assets/plugins/datatables/plugin.css" rel="stylesheet" />
    
@endsection

@section('plugins_js')
  @parent
  <script src="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.js"></script>
  <script src="{{ url('/') }}/themes-tabler/assets/plugins/datatables/plugin.js"></script>
@endsection

@section('page_css')

@endsection

@section('page_js')
    <script type="text/javascript" src="{{ url('/assets/js/acp_distributorlist.js') }}"></script>
@endsection