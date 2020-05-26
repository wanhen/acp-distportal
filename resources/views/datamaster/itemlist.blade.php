@extends('layouts.app')

@section('page_title', 'Daftar Item')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">
    
    <div class="row">
      <!-- page content -->
      
      <div class="card">
        <div class="card-header bg-green">
            <h5 class="card-title text-white"> DAFTAR ITEM </h5>
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
        <div class="col-lg-12 col-md-12 responsive">
            
            
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-1"><label for="">Cari</label></div>
                    <div class="col-md-3"><input type="text" name="" id="" class="form-control"></div>
                    <div class="col-md-3"><button type="submit" class="btn btn-primary bg-green">Go</button></div>
                </div>                
            </form>
            

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Code</td>
                        <td>Nama Item</td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($rec_item as $row)
                    <tr>
                        <td>{{ $rec_item->firstItem() + ($loop->iteration-1) }} </td>
                        <td>{{ $row->item_code }}</td>
                        <td>{{ $row->item_name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $rec_item->links() }}
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
    <script type="text/javascript" src="{{ url('/assets/js/nopage.js') }}"></script>
@endsection