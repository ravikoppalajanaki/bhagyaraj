<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Exam </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/iCheck/square/green.css')}}">

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
	<div class="box-header with-border">
	
	<div class="col-md-2"><img src="{{asset('img/upload')}}/{{$Student->img}}"></div>
	<div class="col-md-10">
	<div class="col-md-3"><strong>Subject :</strong><br />{{$Subject->Name}} <br /><br /><strong>Student Roll No.:</strong> <br />{{$Student->RollNo}}</div>
	<div class="col-md-3"><strong>Test Time : </strong><br />{{$Settings->timing}}<br /><br /><strong>Student Name:</strong><br /> {{$Student->Name}}</div>
	<div class="col-md-3"><strong>No. Of Questions : </strong><br />{{$Settings->noQuestion}}<br /><br /><strong>Supervisor Name:</strong><br /> {{$SV->Name}}</div>
	<div class="col-md-3"><h3 class="pull-right" style="margin-top: 0px; margin-bottom: 10px;"><span class="label label-success" id="timer"></span></h3><button class="btn btn-danger pull-right" onclick="endexam()">End Exam</button></div>
	</div>
	</div>
	
	</div>
	<center></center>
	@php $n = 1; $d = 1; $c = "<table style='display:inline-block;'><tr><td>";@endphp

	<form class="form-horizontal" id="questionform" action="{{url('exam/finished')}}" method="post">
	{!!csrf_field()!!}
	@foreach($QB as $Q)
	<div class="box box-info" id="question{{$n}}" style="display:none;">
	<div class="box-header with-border">
	<div class="col-md-12"><strong>Question {{$n}}: {{$Q->Question}}</strong><input type="hidden" name="questionid[]" value="{{$Q->id}}" /></div>
	</div>
	<div class="box-body">
	@php
if($Q->Option1 != "")
{
	$op[] = $Q->Option1; 
}
if($Q->Option2 != "")
{
	$op[] = $Q->Option2;
}
 
if($Q->Option3 != "")
{
	$op[] = $Q->Option3; 
}

if($Q->Option4 != "")
{
	$op[] = $Q->Option4;
}

  	shuffle($op);
	$c .= '<button class="btn btn-default btn-status" id="'.$n.'" style="margin-top:2px;margin-left:5px;">'.$n.'</button><br />';

         if($d == 15) { $c .= "</td><td>"; $d=0;} 
	@endphp
@if(isset($op[0]))
     <div class="col-md-12"><label><input type="radio" name="ANS[{{$n-1}}]" value="{{$op[0]}}" data-id="{{$n}}">&nbsp; &nbsp; <strong>A.</strong> {{$op[0]}} </label></div>  
@endif
@if(isset($op[1]))    
     <div class="col-md-12"><label><input type="radio" name="ANS[{{$n-1}}]" value="{{$op[1]}}" data-id="{{$n}}">&nbsp; &nbsp; <strong>B.</strong> {{$op[1]}}</label></div>   
@endif
@if(isset($op[2])) 
     <div class="col-md-12"><label><input type="radio" name="ANS[{{$n-1}}]" value="{{$op[2]}}" data-id="{{$n}}">&nbsp; &nbsp; <strong>C.</strong> {{$op[2]}} </label></div>
@endif
@if(isset($op[3])) 
     <div class="col-md-12"><label><input type="radio" name="ANS[{{$n-1}}]" value="{{$op[3]}}" data-id="{{$n}}">&nbsp; &nbsp; <strong>D.</strong> {{$op[3]}} </label></div> 
@endif  
	</div>
	</div>
	@php unset($op);$n++; $d++; @endphp
	@endforeach
@while($d != 15)
@php $c .= "<br />&nbsp;<br />";
$d++; @endphp
@endwhile

	@php $c .= "</td></tr></table>"; @endphp
 
	 <button id="pre" class="btn btn-primary">Previous</button>
			 <button id="next" class="btn btn-primary">Next</button>
			 <input type="hidden" name="TimeTaken" value="" id="TimeTaken">
	</form>
	</div>
	<div class="visible-md-block visible-sm-block visible-lg-block" id="statusbtn" style="position:fixed;top:10px;left:20px;">
	{!!$c!!}
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

		 <!--div style="position:fixed;top:90px;right:20px;">

		 </div-->
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
    <script src="{{asset('plugins/jquery.countdown/jquery.countdown.min.js')}}"></script>
   
	<script>
	$(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-green',
          radioClass: 'iradio_square-green',
          increaseArea: '20%' // optional
        });
	$('input').on('ifChecked', function(event){
    var id = $(this).data(id);
$('#'+id.id).removeClass('btn-default');
$('#'+id.id).addClass('btn-success');
});
      });
	  
var $c = $("#question1");
 $c.show();
$( "#next" ).click(function(event) {
 event.preventDefault();
  $c.hide();
  $c  = $c.next();
 $c.show();
 var nextbtn = $c.attr('id');
 if(nextbtn == "question{{$n - 1}}")
 { 
 $("#next").attr('disabled','disabled');
 $("#pre").removeAttr('disabled');
 }
 else if(nextbtn == "question2")
 {
 $("#pre").removeAttr('disabled');
 }
});

$( "#pre" ).click(function(event) {
 event.preventDefault();
  $c.hide();
  $c  = $c.prev();
 $c.show();
 var nextbtn = $c.attr('id');
 if(nextbtn == "question1")
 { 
 $("#pre").attr('disabled','disabled');
 $("#next").removeAttr('disabled');
 }
 else if(nextbtn == "question{{$n - 2}}")
 {
 $("#next").removeAttr('disabled');
 }
});

$(".btn-status").click(function(event) {
 event.preventDefault();
 var id = $(this).attr('id');
 $c.hide();
 $c = $("#question" + id);
 $c.show();
 if(id == "1")
 { 
 $("#pre").attr('disabled','disabled');
 $("#next").removeAttr('disabled');
 }
 else if(id == {{$n - 1}})
 {
 $("#next").attr('disabled','disabled');
 $("#pre").removeAttr('disabled');
 }
 else
 {
 $("#pre").removeAttr('disabled'); 
 $("#next").removeAttr('disabled');
 }
});

var selectedDate = new Date().valueOf() + 1000 * 60 *{{$Settings->timing}}; 
$("#timer").countdown(selectedDate.toString(),function(event) {
     $(this).text(
       event.strftime('Time Left : %H:%M:%S'),
	   timewarning(event.strftime('%M'))
    );
   })
   .on('finish.countdown', function(event) {
timeup_modal();
 });
   
function timewarning(b){   
  if(b == 5)
	 {
	 jQuery('#timer').removeClass('label-success');
     jQuery('#timer').addClass('label-warning');
	 } 
  else if(b == 2)
	 {
	 jQuery('#timer').removeClass('label-warning');
     jQuery('#timer').addClass('label-danger');
	 }
}
var pauseDate;
function endexam()
{
	var length = $('#statusbtn .btn-success').length;
	var remaining_question = {{$Settings->noQuestion}} - length;
	$('#completed_question').html(length);
	$('#remaining_question').html(remaining_question);
	$('#confirm_modal1').modal({
            backdrop: 'static', 
			keyboard: false
        });
	$('#timer').countdown('pause');
	pauseDate = new Date().valueOf();
}

function confirm_modal1_dismiss()
{
	var timedelta =  new Date().valueOf() - pauseDate;
	selectedDate = selectedDate + timedelta;
	$("#timer").countdown(selectedDate.toString(),function(event) {
     $(this).text(
       event.strftime('Time Left : %H:%M:%S'),
	   timewarning(event.strftime('%M'))
    );
   })
   .on('finish.countdown', function(event) {
timeup_modal();
 });
	$('#confirm_modal1').modal('hide');
}

function confirm_modal2_dismiss()
{
	var timedelta =  new Date().valueOf() - pauseDate;
	selectedDate = selectedDate + timedelta;
	$("#timer").countdown(selectedDate.toString(),function(event) {
     $(this).text(
       event.strftime('Time Left : %H:%M:%S'),
	   timewarning(event.strftime('%M'))
    );
   })
   .on('finish.countdown', function(event) {
timeup_modal();
 });
	$('#confirm_modal2').modal('hide');
}

function confirm_modal1()
{
	$('#confirm_modal1').modal('hide');
	$('#confirm_modal2').modal({
            backdrop: 'static', 
			keyboard: false
        });
}
function confirm_modal2()
{ 	
var Totaltime = 1000 * 60 * {{$Settings->timing}};
var timedelta =  selectedDate - pauseDate;
var timedelta = Totaltime - timedelta;
if(isNaN(timedelta))
{
	timedelta = Totaltime;
}
min = Math.floor(timedelta / 60000);
if(min > 60)
{
	hr = Math.floor(min/60);
	timedelta = timedelta - 1000 * 60 * 60 * hr;
}
else
{
	hr = 0;
}
min = Math.floor(timedelta / 60000);
sec = seconds = ((timedelta % 60000) / 1000).toFixed(0);
if(isNaN(min))
{
	min = 0;
}
if(isNaN(sec))
{
	sec = 0;
}
min = ("0" + min).slice(-2);
sec = ("0" + sec).slice(-2);
hr = ("0" + hr).slice(-2);
$('#TimeTaken').val(hr+":"+min+":"+sec);
console.log($('#TimeTaken').val());
$('#questionform').submit();
}

function timeup_modal()
{
	$('#timeup_modal').modal({
            backdrop: 'static', 
			keyboard: false
        });
	
}

	</script>
		<style>
		.radio input
		{
margin-right:50px;
		}
		</style>
			
		<div class="modal fade"  id="confirm_modal1"  tabindex="-1" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Warning</h4>
              </div>
              <div class="modal-body">
                <p>You have completed <span id="completed_question"></span> questions out of {{$Settings->noQuestion}}&hellip;</p>
                <p><span id="remaining_question"></span> questions are remaining, Do you want to &hellip;</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success pull-left" onclick="confirm_modal1_dismiss()">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="confirm_modal1()">End Exam</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		<div class="modal fade"  id="confirm_modal2"  tabindex="-1" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Confirm Again</h4>
              </div>
              <div class="modal-body">
                <p>Really do you want to end exam ?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success pull-left" onclick="confirm_modal2_dismiss()">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="confirm_modal2()">End Exam</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		<div class="modal fade"  id="timeup_modal"  tabindex="-1" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Time Up</h4>
              </div>
              <div class="modal-body">
                <p>Time has been completed. Click below End Exam to finish exam.</p>
              </div>
              <div class="modal-footer">
                <center><button type="button" class="btn btn-danger btn-lg" onclick="confirm_modal2()">End Exam</button></center>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
  </body>
</html>
