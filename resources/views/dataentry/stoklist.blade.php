@extends('layouts.app')

@section('page_title', 'Stok List')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">
    
    <div class="row">
      <!-- page content -->
      
      <div class="card">
        <div class="card-header bg-green">
            <h5 class="card-title text-white"> STOK LIST </h5>
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
            
            <div class="col-xs-2"> 
            <label for="period">Periode Laporan :  </label>
              <select id="period" name="period" class="form-control-sm">
                @foreach ($rec_period as $item)
                    <option value="{{ $item->period }}" @if ( Session::get("selected_period") == $item->period) selected="selected" @endif>{{ $item->period }}</option>
                @endforeach
              </select>
              <a href="{{ url('/dataentry/stokentry') }}" class="btn btn-sm btn-outline-primary">New</a> 
            </div>
            
            
        </div>
        <div class="table-responsive">
                <table id="mytable" class="table table-striped table-bordered table-hover table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Item Code</th>
                            <th>Nama Item</th>
                            <th>Tgl Expire</th>
                            <th>Qty1</th>
                            <th>Unit1</th>
                            <th>Qty2</th>
                            <th>Unit2</th>
                            <th>Stok</th>
                            <th>Satuan Terkecil</th>
                            <th>Action</th>
                        </tr>                        
                    </thead>
                    <tbody>
                      
                        @foreach ($rec_stok as $item)
                        <tr>
                            <td>{{ $item->item_code }}</td>
                            <td>{{ $item->item_name }}</td>
                            <td>{{ $item->expire_date }}</td>     
                            <td>{{ $item->qty1 }}</td>
                            <td>{{ $item->unit1 }}</td>
                            <td>{{ $item->qty2 }}</td>
                            <td>{{ $item->unit2 }}</td>                       
                            <td>{{ $item->qty }}</td>
                            <td>{{ $item->unit }}</td>
                            
                            <td><a href="{{ url('/dataentry/stokedit/'.$item->id ) }}"><i class="fe fe-edit"></i></a></td>
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
    <script type="text/javascript" src="{{ url('/assets/js/stoklist.js') }}"></script>
@endsection