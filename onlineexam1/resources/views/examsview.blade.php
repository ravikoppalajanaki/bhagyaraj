@extends('main')
@section('pagetitle')
Exams View : List of all Exams View
@endsection
@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Exams View
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{url('exams')}}"><i class="fa fa-dashboard"></i> Exams</a></li>
            <li class="active">Exams View</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">	
		@if(session()->has('success'))
          <div class="row">
		  <div class="col-md-12">
		  <div class="alert alert-success">
		  {{ session()->get('success') }}
		  </div>
		  </div>
		  </div>
		  @endif	
		@if(session()->has('errors'))
          <div class="row">
		  <div class="col-md-12">
		  <div class="alert alert-warning">
		  {{ session()->get('errors') }}
		  </div>
		  </div>
		  </div>
		  @endif
		  
		   <div class="box box-info">
	<div class="box-header border">
	<div class="col-md-4"><strong>Subject :</strong> {{$Subject->Name}}</div>
	<div class="col-md-4"><strong>No. Of Questions : </strong>{{$Exam->TotalQuestion}}</div>
	<div class="col-md-4"><strong>Total Time : </strong>{{$Exam->TotalTiming}}</div>
	</div>
	<div class="box-body">
	<div class="col-md-4"><strong>Student Roll No.:</strong> {{$Student->RollNo}}</div>
	<div class="col-md-4"><strong>Student Name:</strong> {{$Student->Name}}</div>
	<div class="col-md-4"><strong>Supervisor Name:</strong> {{$SV->Name}}</div>
	</div>
	</div>
	<div class="box box-info">
	<div class="box-header">
	<div class="col-md-6"><strong>Attempt Questions: </strong>{{$Exam->correctAnswer + $Exam->IncorrectAnswer}}</div>
	<div class="col-md-6"><strong>Time Taken : </strong>{{$Exam->TimeTaken}}</div>
	</div>
	</div>

	<div class="box box-info">
	<div class="box-header with-border">
	<h3>Result</h3>
	</div>
	<div class="box-body">
	<div class="col-md-4"><strong>Correct Answer :</strong> {{$Exam->correctAnswer}}</div>
	<div class="col-md-4"><strong>Incorrect Answer: </strong>{{$Exam->IncorrectAnswer}}</div>
	<div class="col-md-4"><strong>Un-Attempted Answer: </strong>{{$Exam->UnAttemptAnswer}}</div>
	</div>
	</div>
        </section><!-- /.content -->
@endsection
@section('rightsidebar')
  @include('includes.rightsidebar')
@endsection
@section('extra')
  <script>
	function addstudent()
	{
		$('#Student_add').toggle(500);
	}
	function editstudent(id, rollno, name)
	{
		$('#IDupdate').val(id);
		$('#RollNoUpdate').val(rollno);
		$('#NameUpdate').val(name);
		$('#Student_edit').slideDown(500);
	}
	function deleteexam(a)
	{
		var c = confirm("Are you sure want to delete this exam ?");
		if(c)
		{
		window.location = "{{url('exams/delete/')}}/"+a;
		}
	}
</script>
@endsection