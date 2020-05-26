@extends('layouts.app')
@section('page_title', "ACP - Distributor Portal")


@section('plugins_css')
  @parent  
  
@endsection

@section('plugins_js')
  @parent
 
@endsection

@section('page_css')

@endsection

@section('page_js')
    <script type="text/javascript" src="{{ url('/assets/js/nopage.js') }}"></script>
@endsection

@section('sidebar')

@stop

@section('page_content')
@parent <!-- show parent section, if there are any content -->
    <div class="my-3 my-md-5">
        <div class="container">
          
          <div class="row">
            <!-- page content -->
            
            <div class="card">
                <div class="card-header bg-green">
                  <h3 class="card-title text-white"> Pesan</h3>
                  <div class="card-options"></div>
                </div>
                     
              <div class="card-body">
                <div class="text-wrap p-lg-6">

                 <h2>Sukses menyimpan {{ $menu }}</h2>
                 <a href="{{ url($url_back) }}" class="btn btn-primary bg-green">Lihat Daftar</a>
                 @if ($url_new !== null)
                  <a href="{{ url($url_new) }}" class="btn btn-primary">+ Tambah Baru</a>
                  @endif
                </div>
              </div>
            </div>

           
      
            <!-- end of page content -->
          </div>
        </div>
      </div>
@stop