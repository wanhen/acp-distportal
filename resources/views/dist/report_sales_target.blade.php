@extends('layouts.app')

@section('page_title', 'Report Target Penjualan')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">
    
    <div class="row">
      <!-- page content -->
      
      <div class="card">
        <div class="card-header bg-green">
            <h5 class="card-title text-white"> LAPORAN TARGET PENJUALAN </h5>
            <div class="card-options"> </div>
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

        <!-- Begin body content -->
        <div class="row">          
                       
            <div class="col-xs-3">
                <a href="#" class="btn btn-sm btn-outline-primary">Print</a>            
            </div>
           
        </div>
        <div class="table-responsive">
                <table id="mytable" class="display table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Nama Salesman</th>                           
                            <th>Action</th>
                        </tr>                        
                    </thead>
                    <tbody>
                      
                       
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                           
                        </tr>
                    </tfoot>
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
    <script type="text/javascript" src="{{ url('/assets/js/dist_salesmanlist.js') }}"></script>
@endsection