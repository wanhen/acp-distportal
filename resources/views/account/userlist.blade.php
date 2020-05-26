@extends('layouts.app')

@section('page_title', 'User List')

@section('page_content')
<div class="my-3 my-md-5">
  <div class="container">
    
    <div class="row">
      <!-- page content -->
      
      <div class="card">
        <div class="card-header bg-green">
        <h3 class="card-title text-white"> Daftar User  </h3>
          <div class="card-options">
          <button type="button" class="btn btn-warning btn-sm" onclick="javascript:location.href='{{ url('/admin/user/entry') }}';"><i class="si si-printer"></i> Tambah User</button>
            
          </div>
        </div>
        <div class="card-body">

          <!-- Begin body content -->
          <div class="table-responsive">
                <table id="mytable" class="display table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Group</th>
                            <th>Distributor</th>
                            <th>Action</th>
                        </tr>                        
                    </thead>
                    <tbody>
                        @foreach ($rec_user as $rec)
                            <tr>
                                <td>{{ $rec->username }}</td>
                                <td>{{ $rec->userlevel }}</td>                                
                                <td>{{ $rec->usergroup }}</td>                                
                                <td>{{ $rec->dist_name }}</td>                               
                                <td class="text-center">
                                  <a href="{{ route('user_edit').'/'.$rec->id }}"><i class="fe fe-edit" alt="edit"></a></i>
                                  <a href="{{ url("/dataentry/deleteconfirm/?x=".Crypt::encryptString("id=".$rec->id."&t=users&r=/admin/user")) }}"><i class="fe fe-trash-2" alt="delete"></i></a>
                                </td>
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
                        </tr>
                    </tfoot>
                </table>
          <!-- end of body content -->
                {{ $rec_user->links() }}
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
<link href="{{ url('/') }}/themes-tabler/assets/plugins/datatables/plugin.css" rel="stylesheet" />
<link href="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.css" rel="stylesheet" />


@endsection

@section('plugins_js')
@parent
<script src="{{ url('/') }}/themes-tabler/assets/plugins/datatables/plugin.js"></script>
<script src="{{ url('/') }}/themes-tabler/assets/plugins/jquery-confirm-v3.3.4/plugin.js"></script>

@endsection

@section('page_css')

@endsection

@section('page_js')
    <script type="text/javascript" src="{{ url('/assets/js/userlist.js') }}"></script>
@endsection