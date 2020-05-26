<div>
    <div class="card p-3 @if (Request::segment(3) == 'dist') bg-teal text-white @endif ">
      <div class="d-flex align-items-center">
       
        <div>
          <h4 class="m-0"><i class="fe fe-file"></i><a href="{{ url('admin/report/dist') }}">Daftar Distributor</a></h4>
          <small class="text-muted @if (Request::segment(3) == 'dist') text-white @endif">Ini adalah laporan untuk menampilkan daftar distributor</small>
        </div>
      </div>
    </div>
  </div>
  
<div>
    <div class="card p-3 @if (Request::segment(3) == 'stt') bg-teal text-white @endif ">
      <div class="d-flex align-items-center">
       
        <div>
          <h4 class="m-0"><i class="fe fe-file"></i><a href="{{ url('admin/report/stt') }}">STT Distributor</a></h4>
          <small class="text-muted @if (Request::segment(3) == 'stt') text-white @endif">Ini adalah laporan untuk menampilkan STT distributor berdasarkan periode terpilih</small>
        </div>
      </div>
    </div>
  </div>
  
  <div>
    <div class="card p-3 @if (Request::segment(3) == 'stok') bg-teal text-white @endif">
      <div class="d-flex align-items-center">
       
        <div>
          <h4 class="m-0"><i class="fe fe-file"></i><a href="{{ url('admin/report/stok') }}">Stok Distributor</a></h4>
          <small class="text-muted @if (Request::segment(3) == 'stok') text-white @endif">Ini adalah laporan untuk menampilkan Stok distributor berdasarkan tanggal laporan terpilih</small>
        </div>
      </div>
    </div>
  </div>