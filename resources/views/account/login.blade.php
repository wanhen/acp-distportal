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
    <link rel="icon" href="{{ url('/') }}/themes-tabler/acp_icon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('/') }}/themes-tabler/acp_icon.ico" />
    <!-- Generated: 2018-04-16 09:29:05 +0200 -->
    <title>Login - ACP Distributor Portal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="{{ url('/') }}/themes-tabler/assets/js/require.min.js"></script>
    <script>
      requirejs.config({
        baseUrl: '{{ url('/') }}/themes-tabler'
      });
    </script>
    <!-- Dashboard Core -->
    <link href="{{ url('/') }}/themes-tabler/assets/css/dashboard.css" rel="stylesheet" />
    <script src="{{ url('/') }}/themes-tabler/assets/js/dashboard.js"></script>
  
    <!-- Input Mask Plugin -->
    <script src="{{ url('/') }}/themes-tabler/assets/plugins/input-mask/plugin.js"></script>
  </head>
  <body class="">
    <div class="page">
      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col col-login mx-auto">
              
              <form autocomplete="false" class="card" action="{{ url('account/do_login') }}" method="post">
                {{ csrf_field() }}
                <div class="card-body p-6">
				<div class="text-center mb-6">
					<img src="{{ url('/') }}/assets/images/iss-logo.png" class="h-9" alt="">
          <img src="{{ url('/') }}/assets/images/app-name.png" class="h-7" alt="">
				</div>
                  <!--div class="card-title">Login to your account</div-->
                  @if (session('msg-alert'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('msg-alert') }}!</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                     
                  @endif
                  
                  <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" id="txtusername" name="txtusername" placeholder="Enter username" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label class="form-label">
                      Password                     
                    </label>
                    <input type="password" class="form-control" id="txtpassword" name="txtpassword" placeholder="Enter password" autocomplete="off">
                  </div>
                  <!-- <div class="form-group">
                    <label class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" />
                      <span class="custom-control-label">Remember me</span>
                      <a href="#" class="float-right small">I forgot password</a>
                    </label>
                  </div> -->
                  <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block bg-green">Sign in</button>
                  </div>
                </div>
              </form>
              <!-- <div class="text-center text-muted">
                Don't have account yet? <a href="#">Sign up</a>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </body>
  
</html>
