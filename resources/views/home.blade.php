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
                  <h3 class="card-title text-white"> Distributor Portal - ACP</h3>
                  <div class="card-options"></div>
                </div>
                     
              <div class="card-body">
                <div class="text-wrap p-lg-6">

                  <h2 class="mt-0 mb-4">Selamat Datang di Portal Distributor - ACP</h2>
                  <p>Applikasi ini digunakan untuk pelaporan dan monitoring data STT &amp; Stok distributor</p>
                  <h3 id="add-contact">Panduan Penggunaan</h3>

                  <h4 id="upload-stt">Upload File</h4>

                  <p>Bagi anda distributor, Applikasi ini digunakan sebagai media penyampaian laporan secara online, dengan cara di upload dari format template excel yang sudah ada, untuk melakukan Upload Laporan, ikuti panduan di bawah ini :</p>
                  <ol>
                    <li>Pada menu, klik Upload <a href="/upload">atau klik link ini</a></li>
                    <li>Akan muncul form untuk upload file, pastikan file excel yang akan di upload telah di periksa dengan benar dan telah lengkap terisi klik tombol <code class="highlighter-rouge">+ Pilih file</code> untuk menambahkan memilih file yang akan di upload </li>
                    <li>Pilih file Jenis Laporan yang akan di upload</li>
                    <li>Selanjutnya klik tombol <code class="highlighter-rouge">Submit file</code></li>
                    <li>File yang di upload, akan dilakukan validasi awal oleh program, apabila sukses, program akan menampilkan pesan "Files sukses di upload !", apabila gagal akan muncul pesan "Gagal Upload !"</li>                    
                    <li>File yang sukses di upload akan di lakukan verifikasi oleh Admin ACP, apabila ditemukan kesalahan / ketidaksesuaian, bisa di lihat di menu  <a href="/laporan/status">Laporan Status Upload</a>  </li>
                  </ol>
                  {{-- <p>Selanjutnya kontak dokter akan muncul di daftar, untuk aksi lainnya <code class="highlighter-rouge">Delete</code> dan <code class="highlighter-rouge">Edit</code> , scroll ke kanan dari daftar, kemudian pilih pada link Edit dan Delete .</p> --}}
                  
                  <h4 id="view-report">Melihat Laporan</h4>

                  <p>
                    User dengan level distributor, ada fitur untuk melihat status laporan yang di upload, ada 3 status yang perlu di perhatikan yaitu : 
                    <ul>
                      <li>VERIFIED = laporan telah diterima dan diverifikasi dengan baik oleh tim ACP</li>
                      <li>PENDING = laporan yang di upload, telah diterima namun belum diverifikasi</li>
                      <li>REJECT = laporan yang di upload, ditolak karena kesalahan data atau hal lainnya</li>
                    </ul>
                  </p>

                  <h3 id="format-template">Format Template Laporan</h3>
                  <p>
                    Di bawah ini adalah format template laporan yang bisa di upload, silahkan download sesuai peruntukannya :
                    <ul>
                      <li><a href="#">Template STT</a></li>
                      <li><a href="">Template Laporan Stok</a></li>
                    </ul>
                  </p>

                  <h3 id="format-template">Download Item</h3>
                  <p>
                    Di bawah ini distributor bisa mendownload daftar item yang pernah ada transaksi dgn ACP sehingga bisa jadi master utk lookup :
                    <ul>
                      <li><a href="#">Master {{ Session::get('dist_name') }} Item</a></li>                      
                    </ul>
                  </p>

                  
                </div>
              </div>
            </div>

           
      
            <!-- end of page content -->
          </div>
        </div>
      </div>
@stop