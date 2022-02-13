@if(isset(Auth::user()->id) && Auth::user()->status == 1)
  <script type="text/javascript">
    window.location = "{{ url('dashboard') }}";
  </script>
@elseif((isset(Auth::user()->id) && Auth::user()->status == 2) || !isset(Auth::user()->id))
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>JCT | Sign In</title>
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
       </a>
    </div>
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="{{ route('sign_in') }}" method="post" id="frmSigIn">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" id="btnSignIn"><i class="fa fa-unlock" id="iBtnSignInIcon"></i> <span id="spanBtnSignIn">Sign In</span></button> <br>

            <p class="login-box-msg text-danger pLoginErrMsg"></p>
          </div>
          <!-- /.col -->
        </div>
      </form>
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
