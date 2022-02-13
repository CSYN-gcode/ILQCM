@php
    session_start();
    $isLogin = false;
    if(isset($_SESSION['rapidx_user_id'])){
        $isLogin = true;
    }

    $isAuthorized = false;
    $user_level = 0;
@endphp
@if($isLogin)
    @if($_SESSION['rapidx_user_level_id'] == 3)
        @if(count($_SESSION['rapidx_user_accesses']) > 0)
            @for($index = 0; $index < count($_SESSION['rapidx_user_accesses']); $index++)
                @if($_SESSION['rapidx_user_accesses'][$index]['module_id'] == 21)
                    @php 
                        $isAuthorized = true; 
                        $user_level = $_SESSION['rapidx_user_accesses'][$index]['user_level_id'];
                    @endphp
                    @break
                @endif
            @endfor

            @if(!$isAuthorized)
                <script type="text/javascript">
                    window.location = '../RapidX/';
                </script>
            @endif
        @else
            <script type="text/javascript">
                window.location = '../RapidX/';
            </script>
        @endif
    @endif

    <script type="text/javascript">
        window.location = '../RapidX/';
    </script>

@else
  <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ILQCM | Session Expired</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/png" href="{{ asset('public/images/favicon.png') }}">

  @include('shared.css_links.css_links')
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card" style="box-shadow: 1px 1px 50px black;">
    <br>
    <div class="login-logo">
      <a href="{{ route('login') }}"> 
        <!-- <img src="{{ asset('public/images/favicon.png') }}"
         alt="JCT"
         class="brand-image img-circle elevation-3" style="max-width: 70px;"> -->
         <br>
         <b>In-Line QC Monitoring</b>
         <b><i class="fas fa-exclamation-triangle"></i> Session Expired</b>
       </a>
    </div>
    <div class="card-body login-card-body">
      <p class="login-box-msg">Please click Sign In button to Login RapidX</p>
      <a href="../RapidX/" class="btn btn-primary btn-block" id="btnSignIn"><i class="fa fa-unlock" id="iBtnSignInIcon"></i> <span id="spanBtnSignIn">Sign In</span></a>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- Template JS Links -->
@include('shared.js_links.js_links')

<script type="text/javascript">
  let globalLink = "{{ route('link') }}";

  // JS Confirm Lazy Loading
  let cnfrmLoading = $.dialog({
      lazyOpen: true,
      title: '',
      content: '<i class="fa fa-spinner fa-pulse"></i> Loading...',
      type: 'orange',
      closeIcon: false,
  });
</script>

<!-- Custom Links -->
<script src="{{ asset('public/scripts/client/User.js') }}"></script>

<script type="text/javascript">
  globalLink = "{{ route('link') }}";
  cnfrmLoading = $.dialog({
    lazyOpen: true,
    title: '',
    content: '<i class="fa fa-spinner fa-pulse"></i> Loading...',
    type: 'orange',
    closeIcon: false,
    // autoClose: 'btnAction|8000',
    // backgroundDismiss: true,
  });

  let = cnfrmAutoLogin = $.confirm({
    lazyOpen: true,
    title: 'Session Expired',
    content: 'Your session is expired, you will be automatically logged out in 10 seconds.',
    type: 'red',
    autoClose: 'logoutUser|10000',
    buttons: {
      logoutUser: {
        text: 'Logout now',
        action: function () {
          window.location = dashboard;
        }
      },
    }
  });
  
  let = cnfrmLogout = $.confirm({
    lazyOpen: true,
    title: 'Logout',
    content: 'Please confirm to continue.',
    backgroundDismiss: true,
    type: 'blue',
    buttons: {
      confirm: {
        text: 'Confirm',
        btnClass: 'btn-blue',
        keys: ['enter'],
        action: function(){
          Logout();
        }
      },
      cancel: function () {

      },
    }
  });
  $(document).ready(function(){

    $("#frmSigIn").submit(function(event){
      event.preventDefault();
      SignIn();
    });

  });
</script>
</body>
</html>
@endif
