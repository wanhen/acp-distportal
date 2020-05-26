@extends('layouts.app')

@section('page_title', 'Distributor Salesman List')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">
    
    <div class="row">
      <!-- page content -->
      
      <div class="card">
        <div class="card-header bg-green">
            <h5 class="card-title text-white"> SALESMAN LIST </h5>
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
                <a href="{{ url('/dist/salesmanentry') }}" class="btn btn-sm btn-outline-primary">New Salesman</a>            
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
                      
                        @foreach ($rec_salesman as $item)
                        <tr>
                            <td>{{ $item->sales_code }}</td>
                            <td>{{ $item->sales_name }}</td>
                            <td><a href="{{ url('/dist/salesmanedit/'.$item->id ) }}"><i class="fe fe-edit"></i></a></td>
                        </tr>

                        @endforeach
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