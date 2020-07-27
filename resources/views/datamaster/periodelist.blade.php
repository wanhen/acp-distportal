@extends('layouts.app')

@section('page_title', 'Daftar Periode')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">
    
    <div class="row">
      <!-- page content -->
      
      <div class="card">
        <div class="card-header bg-green">
            <h5 class="card-title text-white"> DAFTAR PERIODE </h5>
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
        <div class="col-lg-6 col-md-6">
          <form id="frmperiode" name="frmperiode" action="{{ url('/datamaster/periode/post') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="">Periode</label>
            <input type="text" name="periode" id="periode" class="form-control" value="{{ $rec_edit ?? '' }}" placeholder="2020-01">
            <button type="button" id="btnsave" name="btnsave" class="btn bg-green text-white">Save</button>
          </div>
          </form>
        </div>
        <div class="col-lg-6 col-md-6">
          <table class="table table-bordered table-hover" id="mytable">
            <thead>
            <tr>
              <td>Periode</td>
              <td>Status</td>
              <td>Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach ($rec_period as $rec)
              <tr>
                <td>{{ $rec->period }}</td>
                <td>
                @if ($rec->is_active == 1)
                <a href="/datamaster/periode/{{ $rec->period }}?a=setinactive"><span class="badge badge-success">Active</span></a>
                @else
                <a href="/datamaster/periode/{{ $rec->period }}?a=setactive"><span class="badge badge-warning">Not Active</span></a>
                @endif
                  
                </td>
                <td><a href="/datamaster/periode/{{ $rec->period }}"><i class="fe fe-edit"></i></a></td>
              </tr>
            </tbody>
            @endforeach
          </table>
          {{ $rec_period->links() }}
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

@endsection

@section('plugins_js')
  @parent
  <script src="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.js"></script>
@endsection

@section('page_css')

@endsection

@section('page_js')
    <script type="text/javascript" src="{{ url('/assets/js/periodelist.js') }}"></script>
@endsection