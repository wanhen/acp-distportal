@extends('layouts.app')

@section('page_title', 'Validasi Laporan')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">
    
    <div class="row">
      <!-- page content -->
      
      <div class="card">
        <div class="card-header bg-green">
        <h3 class="card-title text-white"> Validasi Laporan STT </h3>
          <div class="card-options">
             <a href="{{ route('validate_stt_approve', ['id' => $rec_upload->id]) }}" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> Approve</a>
          </div>
        </div>
        <div class="card-body">
        @php 
          $sum_revenue = 0;
          $sum_diskon = 0;
          foreach ($rec_stt as $rec1)
          {
            $sum_revenue += $rec1->revenue;
            $sum_diskon += $rec1->diskon;
          }
         
          $unique = $rec_stt->unique('nama_item');

        @endphp
        

            <div class="icons-list-wrap">
                <ul class="icons-list">
                    <li class="icons-list-item">Jumlah Record <br /> {{ count($rec_stt) }} </li>
                    <li class="icons-list-item">Jumlah Item <br /> {{ count($unique) }} </li>
                    <li class="icons-list-item">Jumlah Revenue <br /> {{ number_format($sum_revenue,2) }}</li>
                    <li class="icons-list-item">Jumlah Diskon <br /> {{ number_format($sum_diskon,2) }}</li>
                </ul>
            </div>

          
          
          <!-- Begin body content -->
          <div class="table-responsive">
                <table data-toggle="table" data-height="400" data-width="600" data-search="true" data-visible-search="true" data-show-columns="true"
  data-show-footer="false"> 
                    <thead>
                        <tr>
                            <th data-width="20" data-sortable="true">Tanggal</th>
                            <th data-width="20" data-sortable="true">No Faktur</th>
                            <th data-width="20" data-sortable="true">Kode Sales</th>
                            <th data-width="50" data-sortable="true">Nama Sales</th>
                            <th>Kode Customer</th>
                            <th>Nama Customer</th>
                            <th>Alamat</th>
                            <th>Kota</th>
                            <th>Channel</th>
                            <th>Tipe Outlet</th>
                            <th>Brand</th>
                            <th data-sortable="true">Kode Item</th>
                            <th data-sortable="true">Nama Item</th>
                            <th>Kode Item ACP</th>
                            <th>Harga</th>
                            <th>Qty1</th>
                            <th>Unit1</th>
                            <th>Qty2</th>
                            <th>Unit2</th>
                            <th>Qty</th>
                            <th>Unit</th>
                            <th>Diskon</th>
                            <th data-sortable="true">Revenue</th>
                            
                        </tr>                        
                    </thead>
                    <tbody>
                        @foreach ($rec_stt as $rec)
                        <tr>
                            <td data-width="20">{{ $rec->tanggal }}</td>
                            <td data-width="20">{{ $rec->no_faktur }}</td>
                            <td data-width="20">{{ $rec->code_salesman }}</td>
                            <td data-width="50">{{ $rec->nama_salesman }}</td>
                            <td>{{ $rec->code_customer }}</td>
                            <td>{{ $rec->nama_customer }}</td>
                            <td>{{ $rec->alamat }}</td>
                            <td>{{ $rec->kota }}</td>
                            <td>{{ $rec->channel }}</td>
                            <td>{{ $rec->type_outlet }}</td>
                            <td>{{ $rec->brand }}</td>
                            <td>{{ $rec->code_item }}</td>
                            <td>{{ $rec->nama_item }}</td>
                            <td>{{ $rec->code_item_acp }}</td>
                            <td>{{ $rec->harga }}</td>
                            <td>{{ $rec->qty1 }}</td>
                            <td>{{ $rec->unit1 }}</td>
                            <td>{{ $rec->qty2 }}</td>
                            <td>{{ $rec->unit2 }}</td>
                            <td>{{ $rec->qty }}</td>
                            <td>{{ $rec->unit }}</td>
                            <td class="text-right">{{ number_format($rec->diskon,0) }}</td>
                            <td class="text-right">{{ number_format($rec->revenue,0) }}</td>
                            
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
    <script type="text/javascript" src="{{ url('/assets/js/validasiuploadstt.js') }}"></script>
@endsection