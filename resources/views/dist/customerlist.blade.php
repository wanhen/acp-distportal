@extends('layouts.app')

@section('page_title', 'Distributor Customer List')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">
    
    <div class="row">
      <!-- page content -->
      
      <div class="card">
        <div class="card-header bg-green">
            <h5 class="card-title text-white"> CUSTOMER LIST </h5>
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
                <a href="{{ url('/dist/customerentry') }}" class="btn btn-sm btn-outline-primary">New Customer</a>            
            </div>
           
        </div>
        <div class="table-responsive">
                <table data-toggle="table" data-height="400" data-width="600" data-search="true" data-visible-search="true" data-show-columns="true"
  data-show-footer="false">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th data-sortable="true" data-field="cust_name">Nama Customer</th>
                            <th>Channel</th>
                            <th>Tipe</th>
                            <th>Alamat</th>
                            <th>Kota</th>
                            <th>Action</th>
                        </tr>                        
                    </thead>
                    <tbody>
                      
                        @foreach ($rec_customer as $item)
                        <tr>
                            <td>{{ $item->cust_code }}</td>
                            <td>{{ $item->cust_name }}</td>
                            <td>{{ $item->channel }}</td>
                            <td>{{ $item->cust_type }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->city }}</td>
                            <td><a href="{{ url('/dist/customeredit/'.$item->id ) }}"><i class="fe fe-edit"></i></a></td>
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
  <link href="{{ url('/') }}/themes-tabler/assets/plugins/bootstrap-table/plugin.css" rel="stylesheet" />
    
@endsection

@section('plugins_js')
  @parent
  <script src="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.js"></script>
  <script src="{{ url('/') }}/themes-tabler/assets/plugins/bootstrap-table/plugin.js"></script>
@endsection

@section('page_css')

@endsection

@section('page_js')
    <script type="text/javascript" src="{{ url('/assets/js/dist_customerlist.js') }}"></script>
@endsection