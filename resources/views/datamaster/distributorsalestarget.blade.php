@extends('layouts.app')

@section('page_title', 'Distributor Sales Target')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">
    
    <div class="row">
      <!-- page content -->
      
      <div class="card">
        <div class="card-header bg-green">
            <h5 class="card-title text-white"> TARGET SALES DISTRIBUTOR </h5>
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

        <form name="frm_dist" method="post" action="{{ url('datamaster/distributorpost') }}">
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $rec_distributor->id ?? '' }}">
        <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label class="form-label">Kode</label>
                <input type="text" class="form-control" name="dist_code" id="dist_code" value="{{ $rec_distributor->dist_code ?? '' }}" placeholder="Kode" {!! ($rec_distributor->id ?? '') !== ''  ? 'readonly' : '' !!}>
              </div>
              <div class="form-group">
                <label class="form-label">Nama Distributor</label>
                <input type="text" class="form-control" name="dist_name" id="dist_name" value="{{ $rec_distributor->dist_name ?? '' }}" placeholder="Nama Distributor" readonly>
              </div>
              
              <div class="form-group">    
                <label for="period">Periode :  </label>
                <select id="period" name="period" class="form-control-sm">
                    @foreach ($rec_period as $item)
                        <option value="{{ $item->bulan }}" @if ( Session::get("selected_period") == $item->bulan) selected="selected" @endif>{{ $item->bulan }}</option>
                    @endforeach
                </select>                
            </div>      

            <div class="row">
               <table class="table table-hover table-stripped">
                    <thead>
                        <tr>
                            <td>Target </td>
                            <td>Actual </td>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <tr>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                    </tbody>
               </table>
            </div> 

        </div>

            
            

          </div>
          </form>
      
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
  <link href="{{ url('/') }}/themes-tabler/assets/plugins/select2-4.0.5/plugin.css" rel="stylesheet" />
    
@endsection

@section('plugins_js')
  @parent
  <script src="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.js"></script>
  <script src="{{ url('/') }}/themes-tabler/assets/plugins/select2-4.0.5/plugin.js"></script>
@endsection

@section('page_css')

@endsection

@section('page_js')
    <script type="text/javascript" src="{{ url('/assets/js/acp_distributorsalestarget.js') }}"></script>
@endsection