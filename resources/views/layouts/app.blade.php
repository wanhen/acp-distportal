<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    {{-- page token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ url('/') }}/themes-tabler/acp_icon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('/') }}/themes-tabler/acp_icon.ico" />

    <title>ACP Distributor Portal | @yield('page_title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>    
    <script src="{{ url('/') }}/themes-tabler/assets/js/require.min.js"></script>
    <script>
      requirejs.config({
          baseUrl: '{{ url('/') }}/themes-tabler/'
      });

      var baseAppUrl = '{{ url('/') }}';

    </script>



    @section('plugins_css')
    <link href="{{ url('/') }}/themes-tabler/assets/css/dashboard.css" rel="stylesheet" />
    <link href="{{ url('/') }}/themes-tabler/assets/plugins/jquery-ui-1.12.1.custom/plugin.css" rel="stylesheet" />    

    @show

    @section('page_css')

    @show

     <style>
        /* fix bootbox for bootstrap 4 */
        .bootbox .modal-header{
          display: block;
          }

     </style>

  </head>
  <body class="fixed-header">
    <div class="page">
        <div class="page-main">

          <div class="header py-4">
            <div class="container">
              <div class="d-flex">
              <a class="header-brand" href="{{ url('/') }}">
                  <img src="{{ url('/') }}/assets/images/iss-datacenter-logo.png" class="header-brand-img" alt="app logo">
                </a>
                <div class="d-flex order-lg-2 ml-auto">
                  
                @if (Session::get('islogin') == true)
                <div class="dropdown">
                    <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                    <span class="avatar" style="background-image: url({{ url('/') }}/assets/images/person-man-128.png)"></span>

                    <span class="ml-2 d-none d-lg-block">
                        <span class="text-default">{{ strtoupper(Session::get('username')) }}</span>
                        <small class="text-muted d-block mt-1">{{ Session::get('dist_name') }}</small>
                    </span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="{{ url('/account/profile') }}">
                        <i class="dropdown-icon fe fe-user"></i> Profile
                    </a>
                    <a class="dropdown-item" href="{{ url('/account/changepassword') }}">
                        <i class="dropdown-icon fe fe-settings"></i> Change Password
                    </a>
                    {{--
                    <a class="dropdown-item" href="{{ url('/account/inbox') }}">
                        <span class="float-right"><span class="badge badge-primary">6</span></span>
                        <i class="dropdown-icon fe fe-mail"></i> Inbox
                    </a>
                    <a class="dropdown-item" href="{{ url('/account/message') }}">
                        <i class="dropdown-icon fe fe-send"></i> Message
                    </a> --}}
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('/account/help') }}">
                        <i class="dropdown-icon fe fe-help-circle"></i> Bantuan?
                    </a>
                    <a class="dropdown-item" href="{{ url('/account/logout') }}">
                        <i class="dropdown-icon fe fe-log-out"></i> Sign out
                    </a>
                    </div>
                </div>
                @endif
                </div>
                <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                  <span class="header-toggler-icon"></span>
                </a>
              </div>
            </div>
          </div>
          <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse" style="top: 65px; z-index: 10;">
            <div class="container">
              <div class="row align-items-center">
                <div class="col-lg-3 ml-auto">

                </div>
                <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item">
                      <a href="{{ url('/') }}" class="nav-link @if (Request::segment(1) == '') active @endif"><i class="fe fe-home"></i> Home</a>
                    </li>

                    @if (in_array('DISTRIBUTOR', explode(",",Session::get('usergroup'))) == true)
                    <!-- <li class="nav-item dropdown">
                      <a href="javascript:void(0)" class="nav-link @if (Request::segment(1) == 'dist') active @endif" data-toggle="dropdown"><i class="fe fe-check-circle"></i> Master </a>
                      <div class="dropdown-menu dropdown-menu-arrow">
                        <a href="{{ url('/dist/customerlist') }}" class="dropdown-item ">Customer</a>
                        <a href="{{ url('/dist/salesmanlist') }}" class="dropdown-item ">Salesman</a>
                      </div>
                    </li>                    -->
                    <!-- <li class="nav-item dropdown">
                      <a href="javascript:void(0)" class="nav-link @if (Request::segment(1) == 'dataentry') active @endif" data-toggle="dropdown"><i class="fe fe-check-circle"></i> Data Entry </a>
                      <div class="dropdown-menu dropdown-menu-arrow">
                        @if (Session::get('use_upload') == 0)
                        <a href="{{ url('/dataentry/stttranslist') }}" class="dropdown-item ">Entry STT</a>
                        @endif 
                        <a href="{{ url('/dataentry/stoklist') }}" class="dropdown-item ">Entry Stok</a>
                      </div>
                    </li> -->
                    <li class="nav-item ">
                      <a href="{{ url('/upload/stt') }}" class="nav-link @if (Request::segment(1) == 'upload') active @endif"><i class="fe fe-arrow-up-circle"></i> Upload </a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                      <a href="javascript:void(0)" class="nav-link @if (Request::segment(2) == 'report') active @endif" data-toggle="dropdown"><i class="fe fe-book-open"></i> Laporan</a>
                      <div class="dropdown-menu dropdown-menu-arrow">                        
                        <a href="{{ url('/dist/report/salestarget') }}" class="dropdown-item ">Sales Target</a>
                        <a href="{{ url('/dist/report/saleschannel') }}" class="dropdown-item ">Sales by Channel</a>
                        <a href="{{ url('/dist/report/newopenoutlet') }}" class="dropdown-item ">Performance NOO</a>
                        <a href="{{ url('/dist/report/productfocus') }}" class="dropdown-item ">Pencapaian Product Focus</a>
                        <a href="{{ url('/dist/report/brand') }}" class="dropdown-item ">Performance Brand & Sub Brand</a>
                        <a href="{{ url('/dist/report/stockratio') }}" class="dropdown-item ">Stock Ratio</a>
                        <a href="{{ url('/dist/report/accountreceivable') }}" class="dropdown-item ">Piutang Distributor</a>
                        <a href="{{ url('/dist/report/expiredate') }}" class="dropdown-item ">Produk mendekati ED</a>
                        <a href="{{ url('/dist/report/sttandstd') }}" class="dropdown-item ">Perbandingan STT dan STD</a>
                        <a href="{{ url('/dist/report/upload') }}" class="dropdown-item ">Status Upload STT</a>
                      </div>
                    </li> -->
                    @endif
                    @if (in_array('ADMIN', explode(",",Session::get('usergroup'))) == true)
                    <li class="nav-item dropdown">
                      <a href="javascript:void(0)" class="nav-link @if (Request::segment(1) == 'datamaster') active @endif" data-toggle="dropdown"><i class="fe fe-check-circle"></i> Data Master </a>
                      <div class="dropdown-menu dropdown-menu-arrow">
                        <a href="{{ url('/datamaster/periode') }}" class="dropdown-item ">Periode</a>
                        <a href="{{ url('/datamaster/distributor') }}" class="dropdown-item ">Distributor</a>
                        <a href="{{ url('/datamaster/item') }}" class="dropdown-item ">Item</a>
                        <a href="{{ url('/datamaster/itemmapping') }}" class="dropdown-item ">Item Mapping</a>
                      </div>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="javascript:void(0)" class="nav-link @if (Request::segment(1) == 'upload') active @endif" data-toggle="dropdown"><i class="fe fe-arrow-up-circle"></i> Upload </a>
                      <div class="dropdown-menu dropdown-menu-arrow">
                        <a href="{{ url('/upload/sttadmin') }}" class="dropdown-item ">Upload STT Distributor</a>   
                        <a href="{{ url('/upload/stokadmin') }}" class="dropdown-item ">Upload STOK Distributor</a>                      
                        <a href="{{ url('/upload/std') }}" class="dropdown-item">Upload STD ( Sale In )</a>                        
                      </div>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="javascript:void(0)" class="nav-link @if (Request::segment(1) == 'proses' || Request::segment(1) == 'validate') active @endif" data-toggle="dropdown"><i class="fe fe-layers"></i> Proses </a>
                      <div class="dropdown-menu dropdown-menu-arrow">
                        <a href="{{ route('validate_upload_list') }}" class="dropdown-item">Validasi hasil upload</a>
                        <a href="{{ route('validate_entry_list') }}" class="dropdown-item">Validasi hasil input</a>
                        <a href="{{ route('admin_generate_dw') }}" class="dropdown-item">Generate Data warehouse</a>
                      </div>
                    </li>
                    <li class="nav-item ">
                      <a href="{{ url('/admin/report') }}" class="nav-link @if (Request::segment(2) == 'report') active @endif"><i class="fe fe-file"></i> Laporan</a>
                    </li>
                    <li class="nav-item ">
                      <a href="{{ url('/admin/user') }}" class="nav-link @if (Request::segment(2) == 'user') active @endif"><i class="fe fe-user"></i> User Administration</a>
                    </li>
                    @endif


                    <li class="nav-item">
                    <a href="{{ url('/account/help') }}" class="nav-link"><i class="fe fe-file-text"></i> User Guide</a>
                    </li>
                </ul>

                </div>
              </div>
            </div>
          </div>
          <div class="wide-fix"></div>
          @section('page_content')


          @show

    </div>
      <footer class="footer">
        <div class="container">
          <div class="row align-items-center flex-row-reverse">
            <div class="col-auto ml-lg-auto">
              <div class="row align-items-center">
                <div class="col-auto">
                  <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item"><a href="{{ url('/docs') }}">Documentation</a></li>
                    <li class="list-inline-item"><a href="{{ url('/faqs') }}">FAQ</a></li>
                  </ul>
                </div>

              </div>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
              Copyright © 2020 <a href="{{ url('/') }}/">IT Department - PT. Anggana Catur Prima</a>
            </div>
          </div>
        </div>
      </footer>
    </div>

    @section('plugins_js')
    <script src="{{ url('/') }}/themes-tabler/assets/js/dashboard.js"></script>
    <script src="{{ url('/') }}/themes-tabler/assets/plugins/jquery-ui-1.12.1.custom/plugin.js"></script>    
    @show


    @section('page_js')
    <!--script src="{{ url('/') }}/assets/js/{{ (isset($page_js) ? $page_js : 'nopage') }}.js"></script-->

    @show
  </body>
</html>
