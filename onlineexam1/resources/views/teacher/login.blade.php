<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box" style="margin-top:2%;">
      <div class="login-logo">
        <a href="{{url('teacher/login')}}"><img src="{{asset('img/ivect_logo_square.png')}}"><br /><b style="font-size:20px;">INDIAN VOCATIONAL EDUCATION</b><br /><span style="font-size:16px;">Charitable Trust (Govt. Reg. No. E-1703)</span></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your Test</p>
        <form id="form">
		  {!! csrf_field() !!}
          <div class="form-group has-feedback">
            <input type="text" name="Username" id="Username" class="form-control" placeholder="Username">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
         
          <div class="form-group has-feedback">
            <input type="password" name="password" id="password" class="form-control" placeholder="Teacher Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="button" class="btn btn-primary btn-block btn-flat" id="submit">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->	
	 <!--  @if(count($errors) > 0)
<br />	 -->  
<!-- <p class="alert alert-danger">
 @foreach($errors->all() as $error)
           {!!$error!!}<br />
        @endforeach
		</p>
	@endif -->
  <p class="alert alert-danger" id="err" style="display: none;">
    Wrong credentials
  </p>
    </div><!-- /.login-box -->
   

    <!-- jQuery 2.1.4 -->
    <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
    <script type="text/javascript">
      $("#submit").click(function(e){
        e.preventDefault();
        
        var username=$("#Username").val();
        var password=$("#password").val();
        $.ajax({

          url:"{{url('teacher/checkdetails')}}",
          method:"POST",
          data:{_token: "{{ csrf_token() }}",Username:username,password:password},
          success:function(data){
            if($.trim(data)=="success"){
              window.location="{{url('teacher/dashboard')}}";
            }
            if($.trim(data)=="Wrong credentials"){
              $("#err").show();
            }
          }

        });
      });
    </script>
  </body>
</html>
