@extends('layouts.app')

@section('page_title', 'STT List')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">
    
    <div class="row">
      <!-- page content -->
      
      <div class="card">
        <div class="card-header bg-green">
            <h5 class="card-title text-white"> STT LIST </h5>
            <div class="card-options"> </div>
        </div>
        <div class="card-body">
            <div class="card-alert alert alert-warning mb-0 text-center">
                Entry ini akan tertimpa apabila ada record STT yang di upload utk periode yang sama
            </div>
          
          <div class="row row-cards">
            <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                  <div class="card-body p-3 text-center">
                    <div class="text-right text-green">
                      
                      <i class="fe fe-chevron-up"></i>
                    </div>
                    <div class="h3 m-0">Records</div>
                    <div class="text-muted mb-4">{{ $rec_stt_jml_rec }} Record(s)</div>
                  </div>
                </div>
              </div>
          
              <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                  <div class="card-body p-3 text-center">
                    <div class="text-right text-green">
                      
                      <i class="fe fe-chevron-up"></i>
                    </div>
                    <div class="h3 m-0">Amount</div>
                    <div class="text-muted mb-4">Rp.{{ number_format($rec_stt_amount,2) }}</div>
                  </div>
                </div>
              </div>

              <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                  <div class="card-body p-3 text-center">
                    <div class="text-right text-green">
                      
                      <i class="fe fe-chevron-up"></i>
                    </div>
                    <div class="h3 m-0">SKU</div>
                    <div class="text-muted mb-4">{{ $rec_stt_arr_item }} Sku</div>
                  </div>
                </div>
              </div>

              <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                  <div class="card-body p-3 text-center">
                    <div class="text-right text-green">
                      
                      <i class="fe fe-chevron-up"></i>
                    </div>
                    <div class="h3 m-0">Customers</div>
                    <div class="text-muted mb-4">{{ count($rec_stt_arr_customer) }} customers</div>
                  </div>
                </div>
              </div>

              <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                  <div class="card-body p-3 text-center">
                    <div class="text-right text-green">
                      
                      <i class="fe fe-chevron-up"></i>
                    </div>
                    <div class="h3 m-0">Salesman</div>
                    <div class="text-muted mb-4">{{ count($rec_stt_arr_salesman) }} Salesman</div>
                  </div>
                </div>
              </div>

              <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                  <div class="card-body p-3 text-center">
                   
                      <a href="#" class="btn btn-primary bg-green">POSTING</a>
                  </div>
                </div>
              </div>
        </div>

        
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
              <a href="{{ url('/dataentry/stttransentry') }}" class="btn btn-sm btn-outline-primary">New</a>     
            </div>
            <div class="col-xs-3">
                      
            </div>
            
        </div>
        <div class="table-responsive">
                <table id="mytable" class="table table-striped table-bordered table-hover table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>No Faktur</th>
                            <th>Customer</th>
                            <th>Salesman</th>
                            <th>Jml Item</th>
                            <th>Discount</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>                        
                    </thead>
                    <tbody>
                      
                        @foreach ($rec_stttrans as $item)
                        <tr>
                            <td>{{ $item->trans_date }}</td>
                            <td>{{ $item->trans_no }}</td>
                            <td>{{ $item->cust_name }}</td>
                            <td>{{ $item->sales_name }}</td>
                            <td>{{ $item->item_count }}</td>
                            <td>{{ $item->discount }}</td>
                            <td>{{ $item->amount }}</td>
                            <td><a href="{{ url('/dataentry/stttransedit/'.$item->id ) }}"><i class="fe fe-edit"></i></a></td>
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
    <script type="text/javascript" src="{{ url('/assets/js/stttranslist.js') }}"></script>
@endsection