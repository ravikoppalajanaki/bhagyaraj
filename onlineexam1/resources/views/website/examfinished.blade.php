<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Exam Finished</title>
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
    <div class="row">
	<div class="col-md-12">
	&nbsp;<br />
	&nbsp;<br />
	</div>
	<div class="col-md-8 col-md-offset-2">
	<div class="box box-info">
	<div class="box-header border">
	<div class="col-md-4"><strong>Subject :</strong> {{$Subject->Name}}</div>
	<div class="col-md-4"><strong>Test Time : </strong>{{$Settings->timing}}</div>
	<div class="col-md-4"><strong>No. Of Questions : </strong>{{$Settings->noQuestion}}</div>
	</div>
	<div class="box-body">
	<div class="col-md-4"><strong>Student Roll No.:</strong> {{$Student->RollNo}}</div>
	<div class="col-md-4"><strong>Student Name:</strong> {{$Student->Name}}</div>
	<div class="col-md-4"><strong>Supervisor Name:</strong> {{$SV->Name}}</div>
	</div>
	</div>
	<div class="box box-info">
	<div class="box-header">
	<div class="col-md-4"><strong>Total Questions :</strong> {{$Settings->noQuestion}}</div>
	<div class="col-md-4"><strong>Attempt Questions: </strong>{{$correctAnswer + $IncorrectAnswer}}</div>
	<div class="col-md-4"><strong>Time Taken : </strong>{{$TimeTaken}}</div>
	</div>
	</div>
	@if($Settings->showResult == 1)
	<div class="box box-info">
	<div class="box-header with-border">
	<h3>Result</h3>
	</div>
	<div class="box-body">
	<div class="col-md-4"><strong>Correct Answer :</strong> {{$correctAnswer}}</div>
	<div class="col-md-4"><strong>Incorrect Answer: </strong>{{$IncorrectAnswer}}</div>
	<div class="col-md-4"><strong>Un-Attempted Answer: </strong>{{$UnAttemptAnswer}}</div>
	</div>
	</div>
	@endif
	
	</div>
	  @if(count($errors) > 0)
<br />	  
<p class="alert alert-danger">
 @foreach($errors->all() as $error)
           {!!$error!!}<br />
        @endforeach
		</p>
	@endif
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
   
  </body>
</html>
