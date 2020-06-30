@extends('layouts.app')
@section('page_title', "ACP - Distributor Portal - Admin Page")


@section('plugins_css')
@parent
<link href="{{ url('/') }}/themes-tabler/assets/plugins/bootstrap-table/plugin.css" rel="stylesheet" />
<link href="{{ url('/') }}/themes-tabler/assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
<link href="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.css" rel="stylesheet" />
@endsection

@section('plugins_js')
@parent
<script src="{{ url('/') }}/themes-tabler/assets/plugins/bootstrap-table/plugin.js"></script>
<script src="{{ url('/') }}/themes-tabler/assets/plugins/charts-c3/plugin.js"></script>
<script src="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.js"></script>

@endsection

@section('page_css')

@endsection

@section('page_js')
<script type="text/javascript" src="{{ url('/assets/js/home_distributor.js') }}"></script>
@endsection

@section('sidebar')

@stop

@section('page_content')
@parent
<!-- show parent section, if there are any content -->
<div class="my-3 my-md-5">
  <div class="container">

    <div class="row">
      <!-- page content -->

      <div class="card">
        <div class="card-header bg-green">
          <h3 class="card-title text-white"> Distributor Connect - ACP</h3>
          <div class="card-options">
            <select name="period" id="period" class="form-control">
              <option value="">-- Pilih Periode --</option>
              @foreach ($rec_period as $item)
              <option value="{{ $item->period }}" @if ( Session::get("selected_period")==$item->period) selected="selected" @endif>{{ $item->period }}</option>
              @endforeach
            </select>
          </div>
        </div>


        <div class="card-body">
          @if (Session::get('selected_period') == null)
            Belum ada periode yang dipilih
          @else
            Status Upload Laporan <button class="btn btn-primary bg-green">STT</button>
          @endif
        </div>

        <div class="card-body" style="display:none;">

          <div class="row row-cards">
            <div class="col-6 col-sm-4 col-lg-2">
              <div class="card">
                <div class="card-body p-3 text-center">
                  <div class="text-right text-green">
                    6%
                    <i class="fe fe-chevron-up"></i>
                  </div>
                  <div class="h1 m-0">300 - 257</div>
                  <div class="text-muted mb-4">Register Outlet</div>
                </div>
              </div>
            </div>
            <div class="col-6 col-sm-4 col-lg-2">
              <div class="card">
                <div class="card-body p-3 text-center">
                  <div class="text-right text-red">
                    -3%
                    <i class="fe fe-chevron-down"></i>
                  </div>
                  <div class="h1 m-0">17</div>
                  <div class="text-muted mb-4">New Outlet Order</div>
                </div>
              </div>
            </div>
            <div class="col-6 col-sm-4 col-lg-2">
              <div class="card">
                <div class="card-body p-3 text-center">
                  <div class="text-right text-green">
                    9%
                    <i class="fe fe-chevron-up"></i>
                  </div>
                  <div class="h1 m-0">7</div>
                  <div class="text-muted mb-4">Stock Ratio</div>
                </div>
              </div>
            </div>
            <div class="col-6 col-sm-4 col-lg-2">
              <div class="card">
                <div class="card-body p-3 text-center">
                  <div class="text-right text-green">
                    3%
                    <i class="fe fe-chevron-up"></i>
                  </div>
                  <div class="h1 m-0">27.3K</div>
                  <div class="text-muted mb-4">Target Achievement</div>
                </div>
              </div>
            </div>
            <div class="col-6 col-sm-4 col-lg-2">
              <div class="card">
                <div class="card-body p-3 text-center">
                  <div class="text-right text-red">
                    -2%
                    <i class="fe fe-chevron-down"></i>
                  </div>
                  <div class="h1 m-0">$95</div>
                  <div class="text-muted mb-4">AR Outstanding</div>
                </div>
              </div>
            </div>
            <div class="col-6 col-sm-4 col-lg-2">
              <div class="card">
                <div class="card-body p-3 text-center">
                  <div class="text-right text-red">
                    -1%
                    <i class="fe fe-chevron-down"></i>
                  </div>
                  <div class="h1 m-0">621</div>
                  <div class="text-muted mb-4">Products</div>
                </div>
              </div>
            </div>
          </div>

          <div class="text-wrap p-lg-6">

            <!-- <h2 class="mt-0 mb-4">Selamat Datang di Distributor Connect - ACP - Admin</h2> -->

            <div class="row row-card row-deck">

              <div class="col-lg-8">

                <div class="card">
                  <div class="card-header">
                    <h2 class="card-title">Penjualan by Channel</h2>
                  </div>

                  <div id="bar-chart-sales-by-channel"></div>

                </div>
              </div>

              <div class="col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h2 class="card-title">Penjualan by Brand</h2>
                  </div>
                  <div id="pie-chart-sales-by-brand"></div>
                  <!-- <div id="chart-pie" style="height: 12rem;"></div> -->

                </div>
              </div>

              <div class="col-12">

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Produk mendekati ED</h3>
                  </div>
                  <div class="card-body">
                    <table data-toggle="table">
                      <thead>
                        <tr>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>


              </div>

            </div>

          </div>
        </div>
      </div>



      <!-- end of page content -->
    </div>
  </div>
</div>
@stop